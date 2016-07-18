<?php

/**
 * This is the model class for table "entity".
 *
 * The followings are the available columns in table 'entity':
 * @property integer $id_entity
 * @property integer $id_tyentity
 * @property integer $id_device
 * @property string $id_number_entity
 * @property string $description_entity
 *
 * The followings are the available model relations:
 * @property Device $idDevice
 * @property TypeEntity $idTyentity
 * @property Person[] $people
 */
class Entity extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'entity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_tyentity, id_device', 'numerical', 'integerOnly'=>true),
			array('id_number_entity', 'length', 'max'=>500),
			array('description_entity', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_entity, id_tyentity, id_device, id_number_entity, description_entity', 'safe', 'on'=>'search'),
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
			'idDevice' => array(self::BELONGS_TO, 'Device', 'id_device'),
			'idTyentity' => array(self::BELONGS_TO, 'TypeEntity', 'id_tyentity'),
			'people' => array(self::MANY_MANY, 'Person', 'person_entity(id_entity, person_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_entity' => 'Id Entity',
			'id_tyentity' => 'Id Tyentity',
			'id_device' => 'Id Device',
			'id_number_entity' => 'Id Number Entity',
			'description_entity' => 'Description Entity',
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

		$criteria->compare('id_entity',$this->id_entity);
		$criteria->compare('id_tyentity',$this->id_tyentity);
		$criteria->compare('id_device',$this->id_device);
		$criteria->compare('id_number_entity',$this->id_number_entity,true);
		$criteria->compare('description_entity',$this->description_entity,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Entity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
