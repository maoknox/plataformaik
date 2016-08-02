<?php

class ChartsController extends Controller
{
    
        
	
        /**
	 * Llama a vista que muestra gráfico dinámico.
	 */
	public function actionMuestraCharts()
	{
            
            $this->render("_dynamic_charts");            
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
}