    <?php if(Yii::app()->user->isGuest):?>
        <div class="row">
            <div >
                <div class="box">
                    <div class="box-header">

                        <h5>BIENVENIDO</h5>
                    </div>
                    <div class="box-content">
                        <p>
                        Ingetronik.
                        </p>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    <?php else:?>
 <?php 
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/freewall.css');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/freewall.js',CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/centering.js',CClientScript::POS_HEAD);
 ?>
<div id="freewall" class="free-wall" style="max-width: 80%">
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
                            <button class="btn-box" onclick="location.href='<?php echo Yii::app()->baseUrl; ?>/avl/searchVehicle'"><i class="icon-dashboard icon-large"></i><br/>Mis vehículos</button>
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
                            <button class="btn-box" onclick="location.href='<?php echo Yii::app()->baseUrl; ?>/charts/telecontroli'"><i class="icon-dashboard icon-large"></i> Telecontrol-1</button>
                            <button class="btn-box" onclick="location.href='<?php echo Yii::app()->baseUrl; ?>/charts/weatherstation'"><i class="icon-dashboard icon-large"></i> Telemedición</button>
                        </div>
                    </div>
             </div>
         </div>
       </div>
    </div>
    
    
</div>
<!--<div id="freewall" class="free-wall" style="max-width: 100%">
    <div class="brick">                         
        <div class="box" style="text-align: center; ">
            <div class="box-header">
                <i class="icon-bookmark"></i>
                <h5>AVL</h5>
            </div>
            <div class="box-content">
                <div class="btn-group-box">
                    <button class="btn-box" onclick="location.href='<?php echo Yii::app()->baseUrl; ?>/avl/searchVehicle'"><i class="icon-dashboard icon-large"></i><br/>Mis vehículos</button>
                    <button class="btn-box" onclick="location.href='<?php echo Yii::app()->baseUrl; ?>/charts'"><i class="icon-dashboard icon-large"></i> Telemedición</button>
                </div>
            </div>
        </div>                           
    </div>
</div>-->
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


