<?php

class AvlController extends Controller
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
	 * @return array action filters
	 */
	public function filters(){
            return array(
                    'enforcelogin -index muestraArrayTeperatura muestraPuntoTemperatura',                      
            );
	}
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