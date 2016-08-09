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
        
        public function consultaTemperatura(){
            $connect=Yii::app()->db;
            $sql="select date_test, temperatura from test order by date_test desc limit 19";
            $query=$connect->createCommand($sql);
            $read=$query->query();
            $res=$read->readAll();
            $read->close();
            return $res;
        }
}
