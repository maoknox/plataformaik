<?php

class ChartsController extends Controller
{
    
        
	
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
         * Muestra temperaturas
         */
        public function actionPrendeMotor(){
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
            $time=strtotime ($dataTemperatura["date_test"] )*1000;
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
}