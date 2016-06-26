<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
        private $id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
             //echo $this->password;
            //$modeloPersona=new Persona();
            $userResult= Person::model()->find('username=:username',array(':username'=>$this->username));
            //print_r($userResult);echo "asdfadsfasdfadsfadsfasdfasdf";exit;
            //foreach ($userList as $user) {
               // $users["password"]=$user->password;
            //}
            //print_r($userResult);
            if(!is_object($userResult) && !isset($userResult->username)) {
                $this->errorCode = self::ERROR_USERNAME_INVALID;
            }else {
                if($userResult->password !== md5($this->password)){
                    $this->errorCode=self::ERROR_PASSWORD_INVALID;
               }else{
                   $this->errorCode=self::ERROR_NONE;                  
               }                          
            }           
            if($this->errorCode==self::ERROR_NONE){
                $this->id=$userResult->person_id;
                //Person::model()->id=$this->id;
                $rolePerson=$userResult->getCurrentPersonRole();
                $this->setState('roleuser',$rolePerson);
                $auth=Yii::app()->authManager;
                if(!$auth->isAssigned($rolePerson,$this->id))
                {
                   $auth->assign($rolePerson,$this->id);
                   $auth->save();                             
                }      
            }             
            return !$this->errorCode;
	}
        /* Retorna la identificación de la persona
        * @return $this->id
        */
        public function getId()
        {
            return $this->id;
        }
}