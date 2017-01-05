<?php

/**
 * This is the model class for table "test".
 *
 * The followings are the available columns in table 'test':
 * @property integer $id_test
 * @property string $person_id
 * @property string $date_test
 * @property string $temperatura
 * @property string $humedad
 * @property string $conductividad
 * @property string $ph
 *
 * The followings are the available model relations:
 * @property Person $person
 */
class Test extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'test';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('person_id', 'length', 'max'=>100),
			array('date_test, temperatura, humedad, conductividad, ph', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_test, person_id, date_test, temperatura, humedad, conductividad, ph', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'person' => array(self::BELONGS_TO, 'Person', 'person_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_test' => 'Id Test',
			'person_id' => 'Person',
			'date_test' => 'Date Test',
			'temperatura' => 'Temperatura',
			'humedad' => 'Humedad',
			'conductividad' => 'Conductividad',
			'ph' => 'Ph',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_test',$this->id_test);
		$criteria->compare('person_id',$this->person_id,true);
		$criteria->compare('date_test',$this->date_test,true);
		$criteria->compare('temperatura',$this->temperatura,true);
		$criteria->compare('humedad',$this->humedad,true);
		$criteria->compare('conductividad',$this->conductividad,true);
		$criteria->compare('ph',$this->ph,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Test the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        /*
         * Consulta histórico de temperatura a lo sumo 21 datos para inicializar la gráfica
         */
        public function consultaHistoricoTemperatura(){
            $connect=Yii::app()->db;
            $sql="select date_test, temperatura from test where id_device_test='010' order by date_test desc limit 5";
            $query=$connect->createCommand($sql);
            $read=$query->query();
            $res=$read->readAll();
            $read->close();
            return $res;
        }
        /*
         * Consulta última medición de temperatura
         */
        public function consultaPuntoTemperatura(){
            $connect=Yii::app()->db;
            $sql="select date_test, temperatura from test where id_device_test='010' order by date_test desc limit 1";
            $query=$connect->createCommand($sql);
            $read=$query->query();
            $res=$read->read();
            $read->close();
            return $res;
        }
         /*
         * Consulta última medición de ph
         */
        public function consultaPuntoPh(){
            $connect=Yii::app()->db;
            $sql="select date_test, ph from test where id_device_test='010' order by date_test desc limit 1";
            $query=$connect->createCommand($sql);
            $read=$query->query();
            $res=$read->read();
            $read->close();
            return $res;
        }
         /*
         * Consulta última medición de ph
         */
        public function consultaPuntoHumedad(){
            $connect=Yii::app()->db;
            $sql="select date_test, humedad from test where id_device_test='010' order by date_test desc limit 1";
            $query=$connect->createCommand($sql);
            $read=$query->query();
            $res=$read->read();
            $read->close();
            return $res;
        }
        /*
         * Consulta última medición de ph
         */
        public function consultaPuntoConductividad(){
            $connect=Yii::app()->db;
            $sql="select date_test, conductividad from test where id_device_test='010' order by date_test desc limit 1";
            $query=$connect->createCommand($sql);
            $read=$query->query();
            $res=$read->read();
            $read->close();
            return $res;
        }
        /*
         * Consulta última medición de ph
         */
        public function consultaEstados(){
            $connect=Yii::app()->db;
            $sql="select trama_datos from test where id_device_test='010' order by date_test desc limit 1";
            $query=$connect->createCommand($sql);
            $read=$query->query();
            $res=$read->read();
            $read->close();
            return $res;
        }
        /*
         * datos de la estación metereológica
         */
        /*
         * velocidad del viento
         */
        public function consultaVelViento(){
            $connect=Yii::app()->db;
            $sql="select trama_datos from test where id_device_test='020' order by date_test desc limit 1";
            $query=$connect->createCommand($sql);
            $read=$query->query();
            $res=$read->read();
            $read->close();
            $trama=  explode(",", $res['trama_datos']);
            return $trama[6];
        }
        /*
         * lluvia
         */
        public function consultaLluvia(){
            $connect=Yii::app()->db;
            $sql="select trama_datos from test where id_device_test='020' order by date_test desc limit 1";
            $query=$connect->createCommand($sql);
            $read=$query->query();
            $res=$read->read();
            $read->close();
            $trama=  explode(",", $res['trama_datos']);
            return $trama[7];
        }
        /*
         * lluvia
         */
        public function consultaDirViento(){
            $connect=Yii::app()->db;
            $sql="select trama_datos from test where id_device_test='020' order by date_test desc limit 1";
            $query=$connect->createCommand($sql);
            $read=$query->query();
            $res=$read->read();
            $read->close();
            $trama=  explode(",", $res['trama_datos']);
            return $trama[4];
        }
         /*
         * lluvia
         */
        public function consultaHumedad(){
            $connect=Yii::app()->db;
            $sql="select trama_datos from test where id_device_test='020' order by date_test desc limit 1";
            $query=$connect->createCommand($sql);
            $read=$query->query();
            $res=$read->read();
            $read->close();
            $trama=  explode(",", $res['trama_datos']);
            return $trama[10];
        }
         /*
         * lluvia
         */
        public function consultaPTemperaturaWS(){
            $connect=Yii::app()->db;
            $sql="select date_test,trama_datos from test where id_device_test='020' order by date_test desc limit 1";
            $query=$connect->createCommand($sql);
            $read=$query->query();
            $res=$read->read();
            $read->close();
            $trama=  explode(",", $res['trama_datos']);
            $arrayDatosTemp=array('temperatura'=>$trama[9],'tiempo'=>$res['date_test']);
//            [{'temperatura:'$trama[10]},{'tiempo:'$res['trama_datos']}];
            return $arrayDatosTemp;
        }
        /*
         * Consulta histórico de temperatura a lo sumo 21 datos para inicializar la gráfica de estación metereológica
         */
        public function consultaHistoricoTemperaturaWS(){
            $connect=Yii::app()->db;
            $sql="select date_test,trama_datos from test where id_device_test='020' order by date_test desc limit 5";
            $query=$connect->createCommand($sql);
            $read=$query->query();
            $res=$read->readAll();
            $read->close();
            $datos=[];
            if(!empty($res)){
                foreach($res as $key=>$datoTemp){
                    $trama=  explode(",", $datoTemp['trama_datos']);
                    $datos[$key]=array('temperatura'=>$trama[9],'date_test'=>$datoTemp['date_test']);
                }
            }
            return $datos;
        }
        /*
         * Consulta última medición de temperatura de estación metereológica
         */
        public function consultaPuntoTemperaturaWS(){
            $connect=Yii::app()->db;
            $sql="select date_test, temperatura from test where id_device_test='020' order by date_test desc limit 1";
            $query=$connect->createCommand($sql);
            $read=$query->query();
            $res=$read->read();
            $read->close();
            return $res;
        }
        
}
