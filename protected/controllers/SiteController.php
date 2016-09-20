<?php

class SiteController extends Controller
{
    /**
        * Acción que se ejecuta en segunda instancia para verificar si el usuario tiene sesión activa.
        * En caso contrario no podrá acceder a los módulos del aplicativo y generará error de acceso.
        */
        public function filterEnforcelogin($filterChain){
            if(Yii::app()->user->isGuest){
                throw new CHttpException('403',"Debe loguearse primero");
                Yii::app()->user->returnUrl = array("site/login");                                                          
                $this->redirect(Yii::app()->user->returnUrl);
            }
            $filterChain->run();
        }
        /**
	 * @return array action filters
	 */
	public function filters(){
            return array(
                    'enforcelogin -index error login',                      
            );
	}
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

        
        public function actionConsultatyc(){
           $this->render('_consTyC');
        }
        
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
                          
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	
        /**
	 * Acción que renderiza la vista para cambio de clave primera o segunda vez, luego de validaciones modifica contraseña.
	 *
	 * Caso de uso:
	 * - Inicializa modelo person y obtiene los datos de la persona actual.
	 * - Si no hay datos renderiza vista cambiopassword
	 * - Si hay datos, revisa si el cambio de password es por primera vez para asignar escenarios.
         * - Según escenario valida campo adicional de digitar contraseña actual.
         * - Cambia contraseña.
	 * Modelos instanciados:
	 * - Person.
         * @params $_POST, $modeloPerson->attributes
	 */
        public function actionCambiopassword(){           
        /* @var $_POST type */
        if(empty($_POST)){
            //$modeloPerson=new Person();
            $modeloPerson=Person::getCurrentPerson();
            //$modeloPerson=$datosPersona;              
        }
        else{              
            //$modeloPerson=new Person();
            $modeloPerson=Person::getCurrentPerson();
            $modeloPerson->attributes=$_POST["Person"];
            $modeloPerson->newPassword=$_POST["Person"]["newPassword"];
            if($modeloPerson->changepassword){
                $modeloPerson->scenario="changepasswordft";
            }
            else{
                $modeloPerson->scenario="changepassword";                                    
            }
            //$datosInput=Yii::app()->input()->post;}
            if($modeloPerson->validate()){
                $options = [
                    'cost' => 12 //best security/performance cost of blowfish
                ];
                $modeloPerson->password = password_hash($modeloPerson->newPassword, PASSWORD_BCRYPT, $options);
                $modeloPerson->changepassword = false;
                try{                      
                    $modeloPerson->updateByPk($modeloPerson->id, array(
                    'password' => $modeloPerson->password,
                    'changepassword'=>$modeloPerson->changepassword
                    ));
                    Yii::app()->user->setFlash('message', 'Clave modificada satisfactoriamente');                        
                }
                catch(CDbException $e){
                    Yii::app()->user->setFlash('message',$e);
                }                   
            }                                                                                   
        }
        $this->render('cambiopassword',  
        [
            'modeloPerson'=>$modeloPerson
        ]);
    }
        /**
	 * Displays the login page
	 */
	public function actionLogin()
	{
                    $model=new LoginForm;
		// if it is ajax validation request
                    if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
                    {
                            echo CActiveForm::validate($model);
                            Yii::app()->end();
                    }
                    // collect user input data
                    /* @var $_POST type */
                    if(isset($_POST['LoginForm']))
                    {
                        $model->attributes=$_POST['LoginForm'];
                        // validate user input and redirect to the previous page if valid
                        if($model->validate() && $model->login()){
                            $this->redirect(Yii::app()->user->returnUrl);
                            /*if(Yii::app()->user->checkAccess("SuperAdmin")){
                                throw new CHttpException(403,'No tiene acceso a esta acción');
                                
                            } else {
                                $this->redirect(Yii::app()->user->returnUrl);
                            } */                          
                        }
                    }
                    // display the login form
                    $this->render('login',array('model'=>$model));
               
		
	}
 	/**
	 * Aceptar términos y condiciones al ingresar.
	 */
        public function actionAcctyc(){                          
            $modeloPerson=Person::getCurrentPerson();                           
            if(isset($_POST) && !empty($_POST)){
                $modeloPerson->scenario="acctyc";
                $modeloPerson->attributes=$_POST["Person"];                
                if($modeloPerson->validate()){
                    //$modeloPerson->update();                  
                    if($modeloPerson->accepted_tyc=="true"){                       
                        //Yii::app()->user->setState('tyc',$modeloPerson->accepted_tyc);
                        Yii::app()->user->returnUrl = array("site/index");                   
                        try{                      
                            $modeloPerson->updateByPk($modeloPerson->id, array(                        
                                'accepted_tyc'=>$modeloPerson->accepted_tyc
                            ));
                            Yii::app()->user->returnUrl = array("site/index");                           
                            $this->redirect(Yii::app()->user->returnUrl);
                        }
                        catch(CDbException $e){
                            Yii::app()->user->setFlash('message',$e);
                        } 
                    }
                    else{
                        Yii::app()->user->returnUrl = array("site/logout");
                    } 
                    $this->redirect(Yii::app()->user->returnUrl);
                }
            }                       
            $this->render('_formTyC',[
                'model'=>$modeloPerson,
                
            ]);           
        }
        
        
        
	/**
	 * Change the current role by Ajax
	 */
	public function actionUpdateCurrentRoleByAjax()
	{
            $roleName=$_POST['roleName'];
            $roleId=intval($_POST['roleId']);
            $personId=intval($_POST['personId']);
                       
            $personRoles=PersonRole::model()->findAll(array(
                'condition'=>'person_id=:person_id and active=:active',
                'params'=>array(
                        ':person_id'=>$personId,
                        ':active'=>TRUE
                    ),
                )
            );
            
            foreach ($personRoles as $personRole) {
                $personRole->current=FALSE;
                
                if($personRole->role_id===$roleId) {
                    $personRole->current=TRUE;
                    $auth=AuthAssignment::model()->find(array(
                        'condition'=>'userid=:userid',
                        'params'=>array(
                                ':userid'=>$personId
                            ),
                        )
                    );
                    $auth->itemname=$roleName;
                    $auth->update();
                }
                $personRole->update();
            }
            
            echo json_encode(array(
                'success'=>TRUE,
                'auth'=>$auth->itemname
            ));
	}
        
        public function actionFinish(){
            $this->render("finish");
        }
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
                //Yii::app()->user->returnUrl = array("site/finish");                           
                $this->redirect(Yii::app()->user->returnUrl);
		//$this->redirect(Yii::app()->homeUrl);
	}
}