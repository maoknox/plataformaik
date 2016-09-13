<?php
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/charts/charts.css');
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/charts/leds.css');
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/general/sbPanel.css');
    Yii::app()->clientScript->registerCssFile("https://npmcdn.com/leaflet@1.0.0-rc.2/dist/leaflet.css"); 
//    Yii::app()->clientScript->registerScriptFile("https://code.highcharts.com/highcharts.js",CClientScript::POS_HEAD);
//    Yii::app()->clientScript->registerScriptFile("https://code.highcharts.com/highcharts-more.js",CClientScript::POS_HEAD);
//    Yii::app()->clientScript->registerScriptFile("https://code.jquery.com/ui/1.10.4/jquery-ui.min.js",CClientScript::POS_HEAD);
//    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/charts/raphael-2.1.4.min.js",CClientScript::POS_HEAD);
//    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/charts/justgage.js",CClientScript::POS_HEAD);
//    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/jquery.thermometer.js",CClientScript::POS_HEAD);
//    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/charts/mscorlib.js",CClientScript::POS_HEAD);
//    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/charts/PerfectWidgets.js",CClientScript::POS_HEAD);
//    Yii::app()->clientScript->registerScriptFile("https://npmcdn.com/leaflet@1.0.0-rc.2/dist/leaflet.js",CClientScript::POS_HEAD);
//    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/general/sbPanel.js",CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile("http://static.fusioncharts.com/code/latest/fusioncharts.js",CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile("http://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js?cacheBust=56",CClientScript::POS_HEAD);


?>
 
<div class="row ">
    <div class="span4">
        <div class="box">
            <div class="box-header">
                <h5>Telecontrol</h5>
            </div>
        </div>
        <div  class="img-rounded subcontiner">                    
            botones
        </div>
    </div>
    <div class="span8">
        
    </div>
    <div class="span4">
        <div class="box">
            <div class="box-header">
                <h5>Conductividad</h5>
            </div>
        </div>
        <div class="img-rounded subcontiner" >                    
            Configuración de conductividad
        </div>
    </div>
</div>
<hr>
<div class="row ">
    <div class="span3 sistemariego">
        <div class="box">
            <div class="box-header">
                <h5>Fuente hídrica</h5>
            </div>
        </div>
        <div  class="img-rounded subcontiner">                    
            río
        </div>
    </div>
    <div class="span3 sistemariego">
        <div class="box">
            <div class="box-header">
                <h5>Alimentación a reserva</h5>
            </div>
        </div>
        <div  class="img-rounded subcontiner">                    
            Tubo
        </div>
    </div>
    <div class="span3 sistemariego">
        <div class="box">
            <div class="box-header">
                <h5>Reserva</h5>
            </div>
        </div>
        <div id="chart-container"  class="img-rounded subcontiner">                    
            Tanque
        </div>
    </div>
    <div class="span2 sistemariego">
        <div class="box">
            <div class="box-header">
                <h5>Nivel</h5>
            </div>
        </div>
        <div class="img-rounded subcontiner" >                    
            nivel
        </div>
    </div>
    <div class="span3 sistemariego">
        <div class="box">
            <div class="box-header">
                <h5>Sistema de riego</h5>
            </div>
        </div>
        <div  class="img-rounded subsubcontiner">                    
            <div class="row">
                <div class="span3">
                    <div class="box">
                        <div class="box-header">
                            <h5>% Conductividad</h5>
                        </div>
                    </div>
                    <div class="img-rounded subcontiner" >                    
                        nivel
                    </div>
                </div>
            </div>
             <div class="row">
                <div class="span3">
                    <div class="box">
                        <div class="box-header">
                            <h5>% Valvula</h5>
                        </div>
                    </div>
                    <div class="img-rounded subcontiner" >                    
                        nivel
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="span3">
                    <div class="box">
                        <div class="box-header">
                            <h5>% Estado válvula</h5>
                        </div>
                    </div>
                    <div class="img-rounded subcontiner" >                    
                        nivel
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="span4 sistemariego">
        <div class="box">
            <div class="box-header">
                <h5>Cultivo</h5>
            </div>
        </div>
        <div  class="img-rounded subcontiner">                    
            Tanque
        </div>
    </div>
    
</div>
<script type="text/javascript">
  FusionCharts.ready(function(){
    var fusioncharts = new FusionCharts({
    type: 'cylinder',
    dataFormat: 'json',
    id: 'fuelMeter-1',
    renderAt: 'chart-container',
    width: '175',
    height: '250',
    dataSource: {
        "chart": {
            "theme": "fint",
            //"caption": "Diesel Level in Generator",
            //"subcaption": "Bakersfield Central",
            "lowerLimit": "20",
            "upperLimit": "120",
            "lowerLimitDisplay": "Vacío",
            "upperLimitDisplay": "Lleno",
            "numberSuffix": " ltrs",
            "showValue": "1",
            "chartBottomMargin": "25"
        },
        "value": "110"
    },
    "events": {
        "rendered": function(evtObj, argObj) {
            var fuelVolume = 110,
                gaugeRef = evtObj.sender;
            gaugeRef.chartInterval = setInterval(function() {

                (fuelVolume < 10) ? (fuelVolume = 110) : "";
                var consVolume = fuelVolume - (Math.floor(Math.random() * 3));
                gaugeRef.feedData("&value=" + consVolume);
                fuelVolume = consVolume;
            }, 3000);
        },
        "disposed": function(evt, arg) {
            clearInterval(evt.sender.chartInterval);
        }
    }
}
);
    fusioncharts.render();
});
</script>