<?php

/**
 * This is the model class for table "data_frame".
 *
 * The followings are the available columns in table 'data_frame':
 * @property integer $id_dataframe
 * @property integer $id_device
 * @property string $data_frame
 * @property string $entry_date_dataframe
 * @property string $read_date_dataframe
 *
 * The followings are the available model relations:
 * @property Device $idDevice
 */
class DataFrame extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'data_frame';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('data_frame, entry_date_dataframe', 'required'),
			array('id_device', 'numerical', 'integerOnly'=>true),
			array('read_date_dataframe', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_dataframe, id_device, data_frame, entry_date_dataframe, read_date_dataframe', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_dataframe' => 'Id Dataframe',
			'id_device' => 'Id Device',
			'data_frame' => 'Data Frame',
			'entry_date_dataframe' => 'Entry Date Dataframe',
			'read_date_dataframe' => 'Read Date Dataframe',
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

		$criteria->compare('id_dataframe',$this->id_dataframe);
		$criteria->compare('id_device',$this->id_device);
		$criteria->compare('data_frame',$this->data_frame,true);
		$criteria->compare('entry_date_dataframe',$this->entry_date_dataframe,true);
		$criteria->compare('read_date_dataframe',$this->read_date_dataframe,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DataFrame the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
