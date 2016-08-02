<?php

class AvlController extends Controller
{
    
        
	/**
	 * Llama a vista que muestra punto.
	 */
	public function actionSearchVehicle()
	{
            $pk=1;
            $sql="SELECT * FROM localization WHERE id_entity=:id_entity order by localization_time desc";
            $localization=  Localization::model()->findBySql($sql,array(":id_entity"=>$pk));
            $this->render("_search_vehicle",array(
                'localization'=>$localization
            ));            
	}
        /**
	 * Llama a vista que muestra punto.
	 */
	public function actionSearchVehiclePartial()
	{
            $pk=1;
            $sql="SELECT * FROM localization WHERE id_entity=:id_entity order by localization_time desc";
            $localization=  Localization::model()->findBySql($sql,array(":id_entity"=>$pk));
            $this->renderPartial("_search_vehicle_iframe",array(
                'localization'=>$localization
            ));            
	}
        /**
	 * Busca última localización y devuelve array con longitud y latitud.
	 */
        public function actionMuestraPunto(){
            $pk=1;
            $sql="SELECT * FROM localization WHERE id_entity=:id_entity order by localization_time desc";
            $localization=  Localization::model()->findBySql($sql,array(":id_entity"=>$pk));
//		$datosInput=Yii::app()->input->post();
//		$modeloVehiculo=new Vehiculo();
//		$modeloVehiculo->id_vehiculo=$datosInput["idVehiculo"];		
//		$datosVehiculo=$modeloVehiculo->consultarDatosVehiculo();
		echo CJSON::encode(array('latitud'=>$localization->latitude,'longitud'=>$localization->longitude,'time'=>$localization->localization_time));
	}
        public function actionRecordUbication(){
            $pk=1;
            $sql="SELECT * FROM localization WHERE id_entity=:id_entity order by localization_time desc";
            $localization=  Localization::model()->findBySql($sql,array(":id_entity"=>$pk));
            $this->render("_record_ubication1",array(
                'localization'=>$localization
            ));
        }

}