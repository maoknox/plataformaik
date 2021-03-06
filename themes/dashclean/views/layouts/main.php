<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
  
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>                

        <link href="<?php echo Yii::app()->baseUrl; ?>/css/customize-template.css" type="text/css" media="screen, projection" rel="stylesheet" />
<!--        <link rel="stylesheet" href="https://npmcdn.com/leaflet@1.0.0-rc.2/dist/leaflet.css" />-->
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>        
         <?php if(!Yii::app()->user->isGuest):?>                
            <?php
            Yii::app()->clientScript->corePackages = array();
                Yii::app()->clientScript->registerScript('helpers', '
                    urls={                          
                        base: '.CJSON::encode(Yii::app()->baseUrl).',
                        images: '.CJSON::encode(Yii::app()->baseUrl."/images").' 
                    }
                ',CClientScript::POS_HEAD);
                
            ?>        
            <?php  endif?>
        
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php
            Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/notifIt.css');
            Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/notifIt.min.js');
            Yii::app()->clientScript->registerScriptFile("http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js");
            Yii::app()->clientScript->registerScriptFile("http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.min.js");

        ?>
</head>

    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <button class="btn btn-navbar" data-toggle="collapse" data-target="#app-nav-top-bar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="<?php echo Yii::app()->baseUrl; ?>" class="brand"><i>Plataforma <img src="<?php echo Yii::app()->baseUrl; ?>/images/gifik.gif" style="width: 35px;height: 20px"></img></i></a>

                    <div id="app-nav-top-bar" class="nav-collapse">
                        
                        <ul class="nav pull-right">
                            <?php if(!Yii::app()->user->isGuest):?>
                                 <?php echo '<li>'.CHtml::link("Logout",array('site/logout')).'</li>';?>
    <!--                             <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mi cuenta
                                    <b class="caret hidden-phone"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="demo-horizontal-fixed-nav.html">Mis Datos</a>
                                    </li>
                                    <li>
                                        <a href="demo-horizontal-nav.html">Cambiar Clave</a>
                                    </li>                                                                
                                </ul>
                            </li>-->
                            <?php endif;?>
                            <?php if(Yii::app()->user->isGuest):?>
                                <?php echo '<li>'.CHtml::link("Login",array('/site/login')).'</li>';?>
                            <?php endif;?>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="body-container">
            <div id="body-content">               
                
                <!--<section class="container">-->
                    
                    <?php echo $content; ?>
                <!--</section>-->
            </div>
        </div>

        <div id="spinner" class="spinner" style="display:none;">
            Loading&hellip;
        </div>

        <footer class="application-footer">
            <div class="container">               
                <img src="<?php echo Yii::app()->baseUrl; ?>/images/logoik.png" style="width: 80px;height: 50px"></img>
                <p>INGETRONIK</p>
                <div class="disclaimer">
                    <p>Todos los derechos reservados.</p>
                    <p>Copyright © 2016</p>    
                </div>
            </div>
        </footer>
        <?php
            Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/bootstrap/bootstrap-collapse.js");
        ?>
	</body>
</html>