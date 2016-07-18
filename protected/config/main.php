<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
        'timeZone' => 'America/Bogota',
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
        'theme'=>'dashclean',
        'language'=>'es',
	// preloading 'log' component
	'preload'=>array('log'),
    
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
            'gii'=>array(
                    'class'=>'system.gii.GiiModule',
                    'password'=>'root',
                    // If removed, Gii defaults to localhost only. Edit carefully to taste.
                    'ipFilters'=>array('127.0.0.1','::1'),
            ),
            'rbac'=>array(
                    'class'=>'application.modules.rbacui.RbacuiModule',
                    'userClass' => 'Person',
                    'userIdColumn' => 'person_id',
                    'userNameColumn' => 'username',
                    'rbacUiAdmin' => 'SuperAdmin',
                    'rbacUiAssign' => 'registered',
                    //'userActiveScope' => 'isactive',
                ),		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
             // Other stuff.
                'authManager'=>array(
			'class'=>'CDbAuthManager',
                        'connectionID'=>'db',
			'itemTable' => 'auth_item',
			'itemChildTable' => 'auth_item_child',
			'assignmentTable' => 'auth_assignment',
                        //'defaultRoles'=>array('SuperAdmin'), // default Role for logged in users
                        'showErrors'=>true, 
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
//			'urlFormat'=>'path',
//			'rules'=>array(
//				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
//				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
//				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
//			),
                    'urlFormat'=>'path',
                    'showScriptName'=>false,                    
                    'rules'=>array(
                        '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                        '<controller:\w+>/<action:\w+>/<id:\d+>/*'=>'<controller>/<action>',
                        '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                    ),
		),
		
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
                    'tablePrefix'=>'',
                    'connectionString' => 'pgsql:host=localhost;port=5432;dbname=plataformaik',
                    'username'=>'k80014abr13',
                    'password'=>'a564de63c2d0da68cf47586ee05984d7',
                    'charset'=>'UTF8',
                ),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
                'clientScript'=>array(
                    'packages'=>array(
                        'jquery'=>array(
                            'baseUrl'=>'https://ajax.googleapis.com/ajax/libs/jquery/',
                            'js'=>array('1.12.3/jquery.min.js'),
                        )
                    ),
                ),
                  
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);