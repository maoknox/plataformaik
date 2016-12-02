<?php

class ChartsController extends Controller
{
    /**
    * Acción que se ejecuta en segunda instancia para verificar si el usuario tiene sesión activa.
    * En caso contrario no podrá acceder a los módulos del aplicativo y generará error de acceso.
    */
    public function filterEnforcelogin($filterChain){
        if(Yii::app()->user->isGuest){
            throw new CHttpException('403',"Debe loguearse primero");
            Yii::app()->user->returnUrl = array("site/login");                                                          
            $this->redirect(Yii::app()->user->returnUrl);
        }
        $filterChain->run();
    }
    /**
    * Consulta estado de válvulas
    */
    public function actionEstados(){
        $estados=  Test::model()->consultaEstados();
        $subsEstados=explode(",",$estados["trama_datos"] );
        
        echo CJSON::encode(array("motor"=>$subsEstados[count($subsEstados)-2],"electrovalvula"=>$subsEstados[count($subsEstados)-1],"f"=>$subsEstados[count($subsEstados)-3])); 
    }
        /**
	 * @return array action filters
	 */
//	public function filters(){
//            return array(
//                    'enforcelogin',                      
//            );
//	}
        /**
	 * Llama a vista que muestra gráfico dinámico.
	 */
	public function actionIndex()
	{
            
            $this->render("_dynamic_charts");            
	}
         /**
	 * Llama a vista que muestra gráfico dinámico por render partial.
	 */
	public function actionMuestraTemperatura()
	{
            
            $this->renderPartial("_dynamic_charts_iframe");            
	}
         /**
	 * Llama a vista que muestra gráfico dinámico por render partial.
	 */
	public function actionMuestraHumedad()
	{
            
            $this->renderPartial("_dynamicchart_humedad_iframe");            
	}
         /**
	 * Llama a vista que muestra gráfico dinámico por render partial.
	 */
	public function actionMuestraConductividad()
	{
            
            $this->renderPartial("_dynamicchart_conductividad_iframe");            
	}
         /**
	 * Llama a vista que muestra gráfico dinámico por render partial.
	 */
	public function actionMuestraPh()
	{
            
            $this->renderPartial("_dynamiccharts_ph_iframe");            
	}
        /*
         * Muestra temperaturas
         */
        public function actionMuestraArrayTemperatura(){ 
            $modeloTemperatura=  Test::model()->consultaHistoricoTemperatura();
            $ultimoPunto=  Test::model()->consultaPuntoTemperatura();
            $data["puntos"]=array();
            $i=0;
            foreach($modeloTemperatura as $dataTemperatura){
                $time=strtotime ( $dataTemperatura["date_test"] )*1000;                             
                $data["puntos"][]=array("temp"=>(double)$dataTemperatura["temperatura"],"time"=>$time,"tempbd"=>$dataTemperatura["temperatura"]);
            }       
            $data["punto"]=strtotime ( $ultimoPunto["date_test"] )*1000;
            echo CJSON::encode($data);           
        }
        /*
         * Envía comando a central
         */
        public function actionEnviaComando(){
            $fp = fsockopen("52.33.51.182", 8010, $errno, $errstr, 30);
            
            if (!$fp) {
                echo "$errstr ($errno)<br />\n";
            } else {
                $f=$_POST["f"];
                $g=$_POST["g"];
                $h=$_POST["h"];
                $out = "!C,010,A0,B0,C0,D0,E0,".$f.",".$g.",".$h."*";
                //$out = "!N001*";
                fwrite($fp, $out);
                fclose($fp);
            }
            echo CJSON::encode(array("message"=>"mensaje enviado"));
        }
        /*
         * Envía comando de liberación a central
         */
        public function actionLiberarCentral(){
            $fp = fsockopen("52.33.51.182", 8010, $errno, $errstr, 30);
            
            if (!$fp) {
                echo "$errstr ($errno)<br />\n";
            } else {
                $out = "!N001*";
                fwrite($fp, $out);
                fclose($fp);
            }
            echo CJSON::encode(array("message"=>"Mensaje enviado"));
        }
        /*
         * Muestra temperaturas
         */
        public function actionPrendeElectroValvula(){
            $fp = fsockopen("52.33.51.182", 8010, $errno, $errstr, 30);
            
            if (!$fp) {
                echo "$errstr ($errno)<br />\n";
            } else {
                $out = "!C001,A0,B0,C0,D0,E0,F0,G1,H1*";
                //$out = "!N001*";
                fwrite($fp, $out);
                fclose($fp);
            }
            echo CJSON::encode(array("message"=>"Mensaje enviado"));
        }
        /*
         * Muestra temperaturas
         */
        public function actionApagaElectroValvula(){
            $fp = fsockopen("52.33.51.182", 8010, $errno, $errstr, 30);
            
            if (!$fp) {
                echo "$errstr ($errno)<br />\n";
            } else {
                $out = "!C001,A0,B0,C0,D0,E0,F0,G0,H0*";
                //$out = "!N001*";
                fwrite($fp, $out);
                fclose($fp);
            }
            echo CJSON::encode(array("message"=>"Mensaje enviado"));
        }
        /*
         * Muestra temperaturas
         */
        public function actionApagaMotor(){
            $fp = fsockopen("52.33.51.182", 8010, $errno, $errstr, 30);
            
            if (!$fp) {
                echo "$errstr ($errno)<br />\n";
            } else {
                $out = "!C001,A0,B0,C0,D0,E0,F0,G0,H0*";
                //$out = "!N001*";
                fwrite($fp, $out);
                fclose($fp);
            }
            echo CJSON::encode(array("message"=>"Mensaje enviado"));
        }
        /*
         * Muestra última medición de temperatura
         */
        public function actionMuestraPuntoTemperatura(){ 
            $dataTemperatura=  Test::model()->consultaPuntoTemperatura();
            $time=strtotime ($dataTemperatura["date_test"])*1000;
            echo CJSON::encode(array("temp"=>(double)$dataTemperatura["temperatura"],"time"=>$time));
        }
        /*
         * Muestra última medición de ph
         */
        public function actionMuestraPuntoPh(){ 
            $dataPh=  Test::model()->consultaPuntoPh();
            $time=strtotime ( $dataPh["date_test"] )*1000;
            echo CJSON::encode(array("ph"=>(double)$dataPh["ph"],"time"=>$time));
        }
        
        /*
         * Muestra array de puntos de un rango de fecha
         */
        public function actionMuestraArrayPuntos(){ 
            $data=array();            
            $d=0;
            $date="";
            $dateTime=date("Y-m-d H:i:s");    
            $mt = explode(' ', microtime());
    
            for($i=-20;$i<=0;$i++){
                $d=mt_rand(0,30);                
                 // +5 segundos
                //$time = $mt[1] * 1000 + round($mt[0]+($i * 1000));
                
                $time=strtotime ( date("Y-m-d H:i:s") )*1000+($i*1000);
                $data[]=array("temp"=>$d,"time"=>$time);
                $i++;
            }           
           echo CJSON::encode($data);           
        }
        /*
         * Muestra array de puntos de un rango de fecha
         */
        public function actionMuestraPunto(){
            $d=0;
            $date="";
            $dateTime=date("Y-m-d H:i:s");    
            $mt = explode(' ', microtime());            
            $d=mt_rand(0,30);                
            $time=strtotime ( date("Y-m-d H:i:s") )*1000;
            echo CJSON::encode(array("temp"=>$d,"time"=>$time));           
        }
        /*
         * Muestra apunto de lectura de humedad
         */
        public function actionMuestraPuntoHumedad(){
            $dataHumedad=  Test::model()->consultaPuntoHumedad();
            $time=strtotime ( $dataHumedad["date_test"] )*1000;
            echo CJSON::encode(array("humedad"=>(double)$dataHumedad["humedad"],"time"=>$time));        
        }
        /*
         * Muestra array de puntos de un rango de fecha
         */
        public function actionMuestraPuntoConductividad(){
            $dataCond=  Test::model()->consultaPuntoConductividad();
            $time=strtotime ( $dataCond["date_test"] )*1000;
            echo CJSON::encode(array("conductividad"=>(double)$dataCond["conductividad"],"time"=>$time));        
        }
        /*****************************************************************
         * Llama vista para mostrar datos de Estación metereológica
         */
        public function actionWeatherStation(){
            $this->render("_weather_station");
        }
        /*****************************************************************
         * Llama vista para mostrar datos de Estación metereológica
         */
        public function actionTelecontroli(){
            $this->render("_telecontrol");
        }
        /*
         * Datos de la estación metereologica
         */
        /*
         * velocidad del viento
         */
        public function actionMuestraVelViento(){
            $dataVelViento=Test::model()->consultaVelViento();
            echo CJSON::encode(array("velViento"=>(double)$dataVelViento));
        }
        /*
         * precipitación 
         */
        public function actionMuestraLluvia(){
            $dataLluvia=Test::model()->consultaLluvia();
            echo CJSON::encode(array("lluvia"=>(double)$dataLluvia));
        }
         /*
         * precipitación 
         */
        public function actionMuestraDirViento(){
            $dataDirViento=Test::model()->consultaDirViento();
            echo CJSON::encode(array("direccionViento"=>(double)$dataDirViento));
        }
         /*
         * precipitación 
         */
        public function actionMuestraConductividadWS(){
            $dataConductividad=rand (0 , 100 );
            echo CJSON::encode(array("conductividad"=>(double)$dataConductividad));
        }
         /*
         * precipitación 
         */
        public function actionMuestraHumedadWS(){
            $dataHumedad=Test::model()->consultaHumedad();
            echo CJSON::encode(array("humedad"=>(double)$dataHumedad));
        }
        /*
         * Muestra array de puntos de un rango de fecha
         */
        public function actionMuestraPuntoWS(){
            $dataTemp=Test::model()->consultaPTemperaturaWS(); 
            $time=strtotime($dataTemp["tiempo"])*1000;
            echo CJSON::encode(array("temp"=>(double)$dataTemp["temperatura"],"time"=>$time,"tempbd"=>strtotime('2016-11-19 12:46:43.415')*1000,"tempi"=>$dataTemp["tiempo"]));  
        }
        
        /*
         * Muestra temperaturas de estación metereológica
         */
        public function actionMuestraArrayTemperaturaWS(){ 
            $modeloTemperatura=  Test::model()->consultaHistoricoTemperaturaWS();
            $ultimoPunto=  Test::model()->consultaPuntoTemperaturaWS();
            $data["puntos"]=array();
            $i=0;
            foreach($modeloTemperatura as $dataTemperatura){
                $time=strtotime( $dataTemperatura["date_test"] )*1000;                             
                $data["puntos"][]=array("temp"=>(double)$dataTemperatura["temperatura"],"time"=>$time,"tempbd"=>$dataTemperatura["date_test"]);
            }       
            $data["punto"]=strtotime ( $ultimoPunto["date_test"] )*1000;
            echo CJSON::encode($data);           
        }
        
        /*
         * Muestra última medición de temperatura de estación metereológica
         */
        public function actionMuestraPuntoTemperaturaWS(){ 
            $dataTemperatura=  Test::model()->consultaPuntoTemperaturaWS();
            $time=strtotime ($dataTemperatura["date_test"])*1000;
            echo CJSON::encode(array("temp"=>(double)$dataTemperatura["temperatura"],"time"=>$time));
        }
}