<?php

/**
 * This is the model class for table "role".
 *
 * The followings are the available columns in table 'role':
 * @property integer $role_id
 * @property string $name_role
 * @property string $label_role
 * @property string $description_role
 * @property boolean $role_active
 *
 * The followings are the available model relations:
 * @property Person[] $people
 */
class Role extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'role';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name_role, label_role, description_role', 'required'),
			array('name_role, label_role, description_role', 'length', 'max'=>50),
			array('role_active', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('role_id, name_role, label_role, description_role, role_active', 'safe', 'on'=>'search'),
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
			'people' => array(self::MANY_MANY, 'Person', 'person_role(role_id, person_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'role_id' => 'Role',
			'name_role' => 'Name Role',
			'label_role' => 'Label Role',
			'description_role' => 'Description Role',
			'role_active' => 'Role Active',
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

		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('name_role',$this->name_role,true);
		$criteria->compare('label_role',$this->label_role,true);
		$criteria->compare('description_role',$this->description_role,true);
		$criteria->compare('role_active',$this->role_active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Role the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
