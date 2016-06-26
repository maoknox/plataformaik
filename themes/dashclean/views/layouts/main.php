<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
  
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/customize-template.css" type="text/css" media="screen, projection" rel="stylesheet" />
   
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
                <a href="dashboard.html" class="brand"><i class="icon-leaf">Plataforma IK</i></a>
                
                <div id="app-nav-top-bar" class="nav-collapse">
                    <ul class="nav">

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">TRY ME!
                                <b class="caret hidden-phone"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="dashboard.html">Dashboard</a>
                                </li>
                                <li>
                                    <a href="form.html">Form</a>
                                </li>
                                <li>
                                    <a href="custom-view.html">Custom View</a>
                                </li>
                                <li>
                                    <a href="login.html">Login Page</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">CHANGE NAV BAR
                                <b class="caret hidden-phone"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="demo-horizontal-nav.html">Horizontal</a>
                                </li>
                                <li>
                                    <a href="demo-horizontal-fixed-nav.html">Horizontal Fixed</a>
                                </li>
                                <li>
                                    <a href="demo-vertical-nav.html">Vertical</a>
                                </li>
                                <li>
                                    <a href="demo-vertical-fixed-nav.html">Vertical Fixed</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                    <ul class="nav pull-right">
                        <?php if(!Yii::app()->user->isGuest):?>
                             <?php echo '<li>'.CHtml::link("Logout",array('/site/login')).'</li>';?>
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
            <?php echo $content; ?>
        </div>
    </div>
    
    <footer class="application-footer">
        <div class="container">
            <p>Application Footer</p>
            <div class="disclaimer">
                <p>This is an example disclaimer. All right reserved.</p>
                <p>Copyright © keaplogik 2011-2012</p>
            </div>
        </div>
    </footer>  
</body>
</html>