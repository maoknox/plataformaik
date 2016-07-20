<?php

/**
 * This is the model class for table "person".
 *
 * The followings are the available columns in table 'person':
 * @property string $id
 * @property boolean $active
 * @property integer $document_type_id
 * @property string $username
 * @property string $password
 * @property boolean $changepassword
 * @property string $name
 * @property string $lastname
 * @property string $birthdate
 * @property string $email
 * @property string $phone
 * @property string $mobile
 * @property string $address
 * @property integer $document_expedition_city_id
 * @property boolean $personal_data
 * @property boolean $accepted_tyc
 *
 * The followings are the available model relations:
 * @property Taxi[] $taxis
 * @property Session[] $sessions
 * @property Role[] $roles
 * @property Report[] $reports
 * @property Report[] $reports1
 * @property AuthItem[] $authItems
 * @property Calification[] $califications
 * @property City[] $cities
 * @property DocumentType $documentType
 * @property AdministrationPerson[] $administrationPeople
 */
class Person extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'person';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('active, changepassword, personal_data, accepted_tyc', 'required'),
			array('document_type_id, document_expedition_city_id', 'numerical', 'integerOnly'=>true),
			array('username, name, lastname, email, phone, mobile, address', 'length', 'max'=>45),
			array('password, birthdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, active, document_type_id, username, password, changepassword, name, lastname, birthdate, email, phone, mobile, address, document_expedition_city_id, personal_data, accepted_tyc', 'safe', 'on'=>'search'),
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
			'taxis' => array(self::HAS_MANY, 'Taxi', 'person_id'),
			'sessions' => array(self::HAS_MANY, 'Session', 'person_id'),
			'roles' => array(self::MANY_MANY, 'Role', 'person_role(person_id, role_id)'),
			'reports' => array(self::HAS_MANY, 'Report', 'driver_id'),
			'reports1' => array(self::HAS_MANY, 'Report', 'qualifier_id'),
			'authItems' => array(self::MANY_MANY, 'AuthItem', 'auth_assignment(userid, itemname)'),
			'califications' => array(self::HAS_MANY, 'Calification', 'person_id_1'),
			'cities' => array(self::MANY_MANY, 'City', 'num_taxi(person_id, city_id)'),
			'documentType' => array(self::BELONGS_TO, 'DocumentType', 'document_type_id'),
			'administrationPeople' => array(self::MANY_MANY, 'AdministrationPerson', 'person_adminperson(id, peradminpers_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'active' => 'Active',
			'document_type_id' => 'Document Type',
			'username' => 'Username',
			'password' => 'Password',
			'changepassword' => 'Changepassword',
			'name' => 'Name',
			'lastname' => 'Lastname',
			'birthdate' => 'Birthdate',
			'email' => 'Email',
			'phone' => 'Phone',
			'mobile' => 'Mobile',
			'address' => 'Address',
			'document_expedition_city_id' => 'Document Expedition City',
			'personal_data' => 'Personal Data',
			'accepted_tyc' => 'Accepted Tyc',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('document_type_id',$this->document_type_id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('changepassword',$this->changepassword);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('birthdate',$this->birthdate,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('document_expedition_city_id',$this->document_expedition_city_id);
		$criteria->compare('personal_data',$this->personal_data);
		$criteria->compare('accepted_tyc',$this->accepted_tyc);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Person the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        /* Retorna el rol de la persona
        * @return person->active 
        */
        public function getCurrentPersonRole(){
            $personId=$this->person_id;
            $connect=Yii::app()->db;
            $sqlConsPersonRol="select b.name_role from person_role as a left join role as b on a.role_id=b.role_id where a.person_id=:person_id";
            $consPersonRol=$connect->createCommand($sqlConsPersonRol);
            $consPersonRol->bindParam(":person_id", $personId);
            $readPersonRol=$consPersonRol->query();
            $resPersonRol=$readPersonRol->read();
            $readPersonRol->close();          
            return $resPersonRol["name_role"];
        }
}
