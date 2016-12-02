    <?php if(Yii::app()->user->isGuest):?>
    <?php 
    //<!-- PT Sans -->
       Yii::app()->clientScript->registerCssFile('http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600&subset=latin,latin-ext');
       //<!-- Crete Roung -->
       Yii::app()->clientScript->registerCssFile('http://fonts.googleapis.com/css?family=Crete+Round&subset=latin,latin-ext');
       //<!-- CSS -->
       Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/landingpage/reset.css');
       Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/landingpage/base.css');
       Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/landingpage/skeleton.css');
       Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/landingpage/layout.css');
       ?>
<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->



       <header>			
		
		<div class='containerI'>
			<div class='slogan'>
				<div class='ten columns'>
					<h1>INGETRONIK</h1>
					<h2>Plataforma de telemetría y sistemas de información geográfica</h2>
				</div>

				<div class='six columns'>
					<h4>La medición en la nube</h4>
					<p>Todo debe hacerse medible para poder ser gerenciable</p>
				</div>
			</div>
		</div>	
	</header>


	
    <?php else:?>
 <?php 
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/freewall.css');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/freewall.js',CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/centering.js',CClientScript::POS_HEAD);
 ?>

<div class="container">
   
       
        
            <div id="freewall" class="free-wall" style="max-width: 100%">
                <div class="brick">
                    <div  style="text-align: center; ">
                        <div class="span6">
                            <div class="box">
                                <div class="box-header">
                                    <i class="icon-bookmark"></i>
                                    <h5>AVL</h5>
                                </div>
                                <div class="box-content">
                                    <div class="btn-group-box">
                                        <button class="btn-box" onclick="location.href='<?php echo Yii::app()->baseUrl; ?>/avl/searchVehicle'"><i class="icon-road icon-large"></i><br/>Mis vehículos</button>
                                    </div>
                                </div>
                         </div>
                     </div>
                   </div>
                </div>
                <div class="brick">
                    <div  style="text-align: center; ">
                        <div class="span6">
                            <div class="box">
                                <div class="box-header">
                                    <i class="icon-bookmark"></i>
                                    <h5>Metereología-Geofísica-Gis</h5>
                                </div>
                                <div class="box-content">
                                    <div class="btn-group-box">
                                        <button class="btn-box" onclick="location.href='<?php echo Yii::app()->baseUrl; ?>/charts'"><i class="icon-dashboard icon-large"></i> Telecontrol</button>
                                        <!--<button class="btn-box" onclick="location.href='<?php // echo Yii::app()->baseUrl; ?>/charts/telecontroli'"><i class="icon-dashboard icon-large"></i> Telecontrol-1</button>-->
                                        <button class="btn-box" onclick="location.href='<?php echo Yii::app()->baseUrl; ?>/charts/weatherstation'"><i class="icon-dashboard icon-large"></i> Telemedición</button>
                                    </div>
                                </div>
                         </div>
                     </div>
                   </div>
                </div>
            </div>
        
    
</div>
<script>
    var wall = new Freewall("#freewall");
    wall.reset({
            selector: '.brick',
            animate: true,
            cellW: 150,
            cellH: 'auto',
            onResize: function() {
                    wall.fitWidth();
            }
    });
    wall.fitWidth();
    var images = wall.container.find('.brick');
    images.find('img').load(function() {
            wall.fitWidth();
    });
</script>
    <?php endif;?>


