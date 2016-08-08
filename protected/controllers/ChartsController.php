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
         * Muestra array de puntos de un rango de fecha
         */
        public function actionMuestraPuntoHumedadCond(){
            $d=0;
            $d=mt_rand(0,100);
            echo CJSON::encode(array("humedad"=>$d));           
        }
}