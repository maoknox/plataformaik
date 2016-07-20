<?php

/**
 * This is the model class for table "localization".
 *
 * The followings are the available columns in table 'localization':
 * @property integer $id_localization
 * @property integer $id_entity
 * @property string $latitude
 * @property string $longitude
 * @property string $localization_time
 * @property string $aprox_address
 *
 * The followings are the available model relations:
 * @property Entity $idEntity
 */
class Localization extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'localization';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('latitude, longitude, localization_time', 'required'),
			array('id_entity', 'numerical', 'integerOnly'=>true),
			array('latitude, longitude', 'length', 'max'=>50),
			array('aprox_address', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_localization, id_entity, latitude, longitude, localization_time, aprox_address', 'safe', 'on'=>'search'),
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
			'idEntity' => array(self::BELONGS_TO, 'Entity', 'id_entity'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_localization' => 'Id Localization',
			'id_entity' => 'Id Entity',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'localization_time' => 'Localization Time',
			'aprox_address' => 'Aprox Address',
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

		$criteria->compare('id_localization',$this->id_localization);
		$criteria->compare('id_entity',$this->id_entity);
		$criteria->compare('latitude',$this->latitude,true);
		$criteria->compare('longitude',$this->longitude,true);
		$criteria->compare('localization_time',$this->localization_time,true);
		$criteria->compare('aprox_address',$this->aprox_address,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Localization the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
