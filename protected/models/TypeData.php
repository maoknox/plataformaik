<?php

/**
 * This is the model class for table "type_data".
 *
 * The followings are the available columns in table 'type_data':
 * @property integer $id_type_data
 * @property string $name_type_data
 * @property string $label_type_data
 *
 * The followings are the available model relations:
 * @property OrderDataframe[] $orderDataframes
 */
class TypeData extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'type_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name_type_data, label_type_data', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_type_data, name_type_data, label_type_data', 'safe', 'on'=>'search'),
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
			'orderDataframes' => array(self::HAS_MANY, 'OrderDataframe', 'id_type_data'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_type_data' => 'Id Type Data',
			'name_type_data' => 'Name Type Data',
			'label_type_data' => 'Label Type Data',
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

		$criteria->compare('id_type_data',$this->id_type_data);
		$criteria->compare('name_type_data',$this->name_type_data,true);
		$criteria->compare('label_type_data',$this->label_type_data,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TypeData the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
