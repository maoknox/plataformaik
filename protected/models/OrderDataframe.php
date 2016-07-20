<?php

/**
 * This is the model class for table "order_dataframe".
 *
 * The followings are the available columns in table 'order_dataframe':
 * @property integer $id_device
 * @property integer $order_dataframe
 * @property integer $id_type_data
 *
 * The followings are the available model relations:
 * @property TypeData $idTypeData
 * @property Device $idDevice
 */
class OrderDataframe extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_dataframe';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_device, order_dataframe, id_type_data', 'required'),
			array('id_device, order_dataframe, id_type_data', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_device, order_dataframe, id_type_data', 'safe', 'on'=>'search'),
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
			'idTypeData' => array(self::BELONGS_TO, 'TypeData', 'id_type_data'),
			'idDevice' => array(self::BELONGS_TO, 'Device', 'id_device'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_device' => 'Id Device',
			'order_dataframe' => 'Order Dataframe',
			'id_type_data' => 'Id Type Data',
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

		$criteria->compare('id_device',$this->id_device);
		$criteria->compare('order_dataframe',$this->order_dataframe);
		$criteria->compare('id_type_data',$this->id_type_data);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderDataframe the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
