<?php
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/charts/charts.css');
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/charts/leds.css');
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/general/sbPanel.css');
    Yii::app()->clientScript->registerCssFile("https://npmcdn.com/leaflet@1.0.0-rc.2/dist/leaflet.css"); 
//    Yii::app()->clientScript->registerScriptFile("https://code.highcharts.com/highcharts.js",CClientScript::POS_HEAD);
//    Yii::app()->clientScript->registerScriptFile("https://code.highcharts.com/highcharts-more.js",CClientScript::POS_HEAD);
//    Yii::app()->clientScript->registerScriptFile("https://code.jquery.com/ui/1.10.4/jquery-ui.min.js",CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/charts/raphael-2.1.4.min.js",CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/charts/justgage.js",CClientScript::POS_HEAD);
//    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/jquery.thermometer.js",CClientScript::POS_HEAD);
//    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/charts/mscorlib.js",CClientScript::POS_HEAD);
//    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/charts/PerfectWidgets.js",CClientScript::POS_HEAD);
//    Yii::app()->clientScript->registerScriptFile("https://npmcdn.com/leaflet@1.0.0-rc.2/dist/leaflet.js",CClientScript::POS_HEAD);
//    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/general/sbPanel.js",CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile("http://static.fusioncharts.com/code/latest/fusioncharts.js",CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile("http://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js?cacheBust=56",CClientScript::POS_HEAD);

// River Created by Kemesh Maharjan from the Noun Project
?>
 <section class="nav nav-page" >
        <div class="container" >
        
            <div class="span7">
                <header class="page-header">
                    </br>
                    
                        Módulo Meteorología-Central
                    
                </header>
            </div>
            <div class="page-nav-options">
                <div class="span9">
                    <ul class="nav nav-pills">
                        <li>
                            <a href="<?php echo Yii::app()->baseUrl; ?>""><i class="icon-home icon-large"></i></a>
                        </li>
                    </ul>
                    <ul class="nav nav-tabs">
                        <li>
                            <a href="#"><i class="icon-home"></i>Geozonas</a>
                        </li>
                        <li><a href="#">Estadísticas</a></li>
                    </ul>
                </div>
            </div>
        
    </div>
</section>    
<div class="container">
    <div class="row " >
         <div class="span4">
            <div class="box">
                <div class="box-header">                
                    <h5>Telecontrol- Motor</h5>
                </div>
                <div class="box-content" >  
                    <div  id="divLedMotor"></div>   
                </div>
            </div>
            <div class="box">
                <div class="box-content" >
                    <div  style="text-align: center" >
                        <?php echo CHtml::button("Iniciar Proceso",array("id"=>"btnActivaMotor" , "style"=>"display:none","onClick"=>"js:enviaComando('prendeMotor','G1')"));?>
                        <?php echo CHtml::button("Detener Proceso",array("id"=>"btnDesactivaMotor", "style"=>"display:none","onClick"=>"js:enviaComando('apagaMotor','G0')"));?>
                    </div>
                </div>
            </div>
        </div>
        <div class="span6">

        </div>
        <div class="span5">
            <div class="box">
                <div class="box-header">                
                    <h5>Conductividad</h5>
                </div>
                <div class="box-content" >  
                    <div id="g1"></div>   
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row" >
        
        <div class="span3" >
            <div class="box">
                <div class="box-header">
                    <h5>Fuente hídrica</h5>
                </div>
            </div>
            <div  class="img-rounded subcontiner">                    
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 90 112.5" enable-background="new 0 0 90 90" xml:space="preserve"><path d="M36.358,53.494c5.741-3.636,10.257-1.86,11.165-5.007c0.839-2.907-2.219-6.212-2.219-6.212L33.346,30.318  c-0.625-0.625-1.637-0.625-2.262,0L0.967,60.435h26.176h9.279C36.422,60.435,30.616,57.13,36.358,53.494z"/><path d="M58.392,52.802c0,2.86-3.98,6.375,8.46,7.633H89.64L59.523,30.318c-0.625-0.625-1.637-0.625-2.262,0L45.303,42.275  C45.303,42.275,58.392,46.793,58.392,52.802z"/><g><path d="M48.558,50.534l-0.096-0.175c0.786-0.429,0.387-2.262,0.383-2.28l0.195-0.044C49.059,48.116,49.476,50.033,48.558,50.534z"/></g><g><path d="M55.492,50.466l-0.196-0.038c0.174-0.893-1.46-2.28-1.477-2.294l0.129-0.153C54.019,48.04,55.688,49.459,55.492,50.466z"/></g><g><path d="M40.501,57.24c-0.807-0.477-1.189-1.005-1.136-1.569c0.142-1.513,3.397-2.704,3.536-2.754l0.068,0.188   c-0.033,0.012-3.274,1.197-3.405,2.584c-0.045,0.481,0.304,0.945,1.038,1.378L40.501,57.24z"/></g><g><path d="M48.144,57.221c-0.671-0.724-0.963-1.466-0.866-2.207c0.166-1.265,1.397-2.056,1.449-2.089l0.107,0.169   c-0.012,0.008-1.205,0.775-1.358,1.947c-0.088,0.678,0.186,1.366,0.814,2.044L48.144,57.221z"/></g><g><path d="M54.617,57.244c-0.781-0.373-1.093-1.238-0.9-2.5c0.142-0.931,0.501-1.74,0.516-1.774l0.182,0.082   c-0.014,0.032-1.407,3.202,0.289,4.012L54.617,57.244z"/></g><g><path d="M51.775,50.189L51.6,50.093c0.452-0.829,0-1.988-0.005-2l0.186-0.074C51.801,48.071,52.272,49.276,51.775,50.189z"/></g><g><ellipse cx="48.917" cy="47.718" rx="0.137" ry="0.114"/></g><g><ellipse cx="51.551" cy="47.718" rx="0.137" ry="0.114"/></g><g><ellipse cx="53.678" cy="47.718" rx="0.137" ry="0.114"/></g></svg>

            </div>
        </div>
        <div class="span3">
            <div class="box">
                <div class="box-header">
                    <h5>Alimentación a reserva</h5>
                </div>
            </div>
            <div  class="img-rounded subcontiner">                    
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="1px" y="35px" width="150px" height="60px" viewBox="1 35 97 30" enable-background="1 35 97 30" xml:space="preserve"><g xmlns="http://www.w3.org/2000/svg">
             <g id="shape">
    <polygon fill="#993300" points="67.442,45.21 1.744,50.27 1.744,50.27 67.442,55.329 63.226,65.257 98.75,50.27 63.226,35.279 "></polygon>
    </g>
    </g></svg>
            </div>
        </div>
        <div class="span3">
            <div class="box">
                <div class="box-header">
                    <h5>Reserva</h5>
                </div>
            </div>
            <div id="chart-container"  class="img-rounded subcontiner">                    
                Tanque
            </div>
        </div>

        <div class="span4">
            <div class="box">
                <div class="box-header">
                    <h5>Sistema de riego</h5>
                </div>
            
                <div  class="box-content">                                
                 
                    <div class="span4">
                        <div class="box">
                            <div class="box-header">
                                <h5> Valvula</h5>
                            </div>
                        </div>
                        <div > 
                            <div style="display: none" class="span2">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="16px" width="94px" height="68px" viewBox="0 16 94 68" enable-background="0 16 94 68" xml:space="preserve">
                                    <g xmlns="http://www.w3.org/2000/svg">
                                            <g id="shape">
                                                    <path fill="#999999" d="M94.667,74.64l-1.129-1.511l0.997-1.227l-1.071-1.374l1.071-1.357l-1.071-1.25l1.071-1.392l-1.071-1.481
                                                            l0.803-1.571l-0.803-1.222l1.071-1.616H59.852c-1.749-2.731-4.33-4.876-7.384-6.083L40.199,42.288
                                                            c-0.643-0.643-1.004-1.514-1.004-2.423V19.439c0-1.774-1.438-3.213-3.213-3.213h-4.605c-1.774,0-3.213,1.438-3.213,3.213v25.245
                                                            c0,0.909,0.361,1.781,1.004,2.423l8.984,8.984c-1.782,1.193-3.307,2.74-4.465,4.548H1.147l-1.071,1.616l1.071,1.026l-1.071,1.142
                                                            l1.071,1.571l-1.071,1.428l1.071,1.571L0.076,70.42l1.071,1.428l-1.071,1.285l1.071,1.285l-1.071,1.329l1.071,1.616h32.541
                                                            c2.76,4.309,7.586,7.167,13.082,7.167c5.496,0,10.322-2.858,13.082-7.167h34.682l-1.071-1.616L94.667,74.64z"></path>
                                            </g>
                                            <g id="light">
                                                    <path fill="#0071BC" d="M33.017,69.001c0-2.45,0.647-4.745,1.77-6.737v-0.01H0.076l1.071,1.026l-1.071,1.142l1.071,1.571
                                                            l-1.071,1.428l1.071,1.571L0.076,70.42l1.071,1.428l-1.071,1.285l1.071,1.285l-1.071,1.329h34.711v-0.01
                                                            C33.664,73.746,33.017,71.451,33.017,69.001z"></path>
                                            </g>
                                            <g id="dark">
                                                    <path fill="#CCCCCC" d="M60.522,69.001c0-5.143-2.825-9.624-7.006-11.983v23.965C57.697,78.625,60.522,74.144,60.522,69.001z"></path>
                                                    <path fill="#CCCCCC" d="M33.017,69.001c0,5.143,2.825,9.624,7.006,11.983V57.018C35.842,59.378,33.017,63.858,33.017,69.001z"></path>
                                                    <path fill="#CCCCCC" d="M93.538,73.129l0.997-1.227l-1.071-1.374l1.071-1.357l-1.071-1.25l1.071-1.392l-1.071-1.481l0.803-1.571
                                                            l-0.803-1.222H60.758c0.987,2.04,1.541,4.328,1.541,6.747s-0.554,4.707-1.541,6.747h32.706l1.203-1.107L93.538,73.129z"></path>
                                            </g>
                                            <g id="shadow">
                                                    <path fill="#C1272D" d="M38.153,56.091c2.466-1.651,5.427-2.619,8.617-2.619c2.013,0,3.934,0.387,5.698,1.084L40.199,42.288
                                                            c-0.643-0.643-1.004-1.514-1.004-2.423V19.439c0-1.774-1.438-3.213-3.213-3.213h-4.605c-1.774,0-3.213,1.438-3.213,3.213v25.245
                                                            c0,0.909,0.361,1.781,1.004,2.423L38.153,56.091z"></path>
                                            </g>

                                         <g id="dark">
                                                    <path fill="#CCCCCC" d="M60.522,69.001c0-5.143-2.825-9.624-7.006-11.983v23.965C57.697,78.625,60.522,74.144,60.522,69.001z"></path>
                                                    <path fill="#CCCCCC" d="M33.017,69.001c0,5.143,2.825,9.624,7.006,11.983V57.018C35.842,59.378,33.017,63.858,33.017,69.001z"></path>
                                                    <path fill="#CCCCCC" d="M93.538,73.129l0.997-1.227l-1.071-1.374l1.071-1.357l-1.071-1.25l1.071-1.392l-1.071-1.481l0.803-1.571
                                                            l-0.803-1.222H60.758c0.987,2.04,1.541,4.328,1.541,6.747s-0.554,4.707-1.541,6.747h32.706l1.203-1.107L93.538,73.129z"></path>
                                            </g>
                                    </g>
                                </svg>

                            </div>
                            <div style="display: block" class="span2">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="49px" width="100px" height="35px" viewBox="0 49 100 35" enable-background="0 49 100 35" xml:space="preserve">
                                    <g xmlns="http://www.w3.org/2000/svg">
                                    <g id="shape">
                                            <path fill="#999999" d="M96.863,49.156H71.618c-0.909,0-1.781,0.361-2.423,1.004l-9.805,9.805
                                                    c-2.818-3.928-7.417-6.492-12.62-6.492c-5.496,0-10.322,2.858-13.082,7.167H1.147l-1.071,1.616l1.071,1.026l-1.071,1.142
                                                    l1.071,1.571l-1.071,1.428l1.071,1.571L0.076,70.42l1.071,1.428l-1.071,1.285l1.071,1.285l-1.071,1.329l1.071,1.616h32.541
                                                    c2.76,4.309,7.586,7.167,13.082,7.167c5.496,0,10.322-2.858,13.082-7.167h34.682l-1.071-1.616l1.203-1.107l-1.129-1.511
                                                    l0.997-1.227l-1.071-1.374l1.071-1.357l-1.071-1.25l1.071-1.392l-1.071-1.481l0.803-1.571l-0.803-1.222l1.071-1.616H74.766
                                                    c0.508-0.285,1.078-0.453,1.672-0.453h20.426c1.774,0,3.213-1.438,3.213-3.213v-4.604C100.076,50.594,98.638,49.156,96.863,49.156z
                                                    "></path>
                                    </g>
                                    <g id="shadow">
                                            <path fill="#C1272D" d="M96.863,49.156H71.618c-0.909,0-1.781,0.361-2.423,1.004l-9.805,9.805c0.159,0.221,0.315,0.445,0.462,0.675
                                                    h14.914c0.508-0.285,1.078-0.453,1.672-0.453h20.426c1.774,0,3.213-1.438,3.213-3.213v-4.604
                                                    C100.076,50.594,98.638,49.156,96.863,49.156z"></path>
                                    </g>
                                    <g id="light">
                                            <polygon fill="#0071BC" points="93.464,75.748 94.666,74.64 93.538,73.129 94.535,71.902 93.464,70.527 94.535,69.171 
                                                    93.464,67.921 94.535,66.529 93.464,65.047 94.267,63.477 93.464,62.255 0.076,62.255 1.147,63.28 0.076,64.423 1.147,65.993 
                                                    0.076,67.421 1.147,68.992 0.076,70.42 1.147,71.848 0.076,73.133 1.147,74.418 0.076,75.748 	"></polygon>
                                    </g>
                                    <g id="dark">
                                            <path fill="#CCCCCC" d="M46.77,82.754c5.143,0,9.624-2.825,11.983-7.006H34.787C37.146,79.929,41.627,82.754,46.77,82.754z"></path>
                                            <path fill="#CCCCCC" d="M46.77,55.249c-5.143,0-9.624,2.825-11.983,7.006h23.965C56.393,58.074,51.913,55.249,46.77,55.249z"></path>
                                    </g>
                                    <g id="hlight">
                                            <path fill="#FF7A7F" d="M60.525,60.4c-0.128,0-0.256-0.049-0.354-0.146c-0.195-0.195-0.195-0.512,0-0.707l9.205-9.205
                                                    c0.741-0.742,1.727-1.15,2.777-1.15h25.245c0.276,0,0.5,0.224,0.5,0.5s-0.224,0.5-0.5,0.5H72.154c-0.783,0-1.518,0.305-2.069,0.857
                                                    l-9.206,9.205C60.781,60.352,60.653,60.4,60.525,60.4z"></path>
                                    </g>
                            </g></svg>
                            </div>

                        </div>
                    </div>
                

                
                    <div class="span4">
                        <div class="box">
                            <div class="box-header">
                                <h5>% Estado válvula</h5>
                            </div>
                        </div>
                        <div class="img-rounded subcontiner" >                    
                            <div class="row" class="span-6"><div ><div  class="led-red"></div></div></div>
                        </div>
                    </div>
                
            </div>
        
    </div>
</div>    
<script type="text/javascript">
    /* Telecontrol Motor*/
function enviaComando(action,state){   
    if(action==="apagaMotor"){
        $("#estadoMotor").val("G0");
        $("#divLedMotor").removeClass();
        $("#divLedMotor").addClass("led-red");
    }
    else if(action === "prendeMotor"){
        $("#estadoMotor").val("G1");
        $("#divLedMotor").removeClass();
        $("#divLedMotor").addClass("led-green");
    }
    else if(action === "prendeElectroValvula"){
        $("#estadoEValvula").val("H1");
        $("#divLedElValv").removeClass();
        $("#divLedElValv").addClass("led-green");
        
    }
    else if(action === "apagaElectroValvula"){
        $("#estadoEValvula").val("H0");
        $("#divLedElValv").removeClass();
        $("#divLedElValv").addClass("led-red");
    }
    
    var data = 'h='+$("#estadoEValvula").val()+'&g='+$("#estadoMotor").val()+'&f='+$("#estadoF").val(); 
    $.ajax({
        url: "<?php echo Yii::app()->baseUrl?>/charts/enviaComando",                              
        type: "post",
        //data: "{h: "+$("#estadoEValvula").val()+", g:"+$("#estadoMotor").val()+",f:"+$("#estadoF").val()+"}",
        data:data,
        dataType:"json",
        //beforeSend:function (){Loading.show();},
        success: function(dataPointJson){
            console.debug(dataPointJson);                                                                  
        },
        error:function (err){
            console.debug(err);
        }
    });
}
/*
* Fin telecontrol
 */
 /*
 * Visualización reserva agua
  */
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
/*
* Fin reserva agua
 */
 function consultaEstadoMotor(){
     $.ajax({
            url: "<?php echo Yii::app()->baseUrl?>/charts/estados",                        
            dataType:"json",
            type: "post",
            //beforeSend:function (){Loading.show();},
            success: function(dataPointJson){
                $("#divLedMotor").removeClass();
                $("#divLedElValv").removeClass();
                $("#btnActivaMotor").hide();
                $("#btnDesactivaMotor").hide();
                $("#btnActivaElValv").hide();
                $("#btnDesactivaElValv").hide();
                if(dataPointJson.motor==="G1"){
                    $("#divLedMotor").addClass("led-green");
                    $("#estadoMotor").val("G1");
                    $("#btnDesactivaMotor").show();                        
                }
                else{
                    $("#divLedMotor").addClass("led-red");
                    $("#estadoMotor").val("G0");
                    $("#btnActivaMotor").show();
                }
                if(dataPointJson.electrovalvula==="H1"){
                    $("#divLedElValv").addClass("led-green");
                    $("#estadoEValvula").val("H1");   
                    $("#btnDesactivaElValv").show();
                }
                else{
                    $("#divLedElValv").addClass("led-red");
                    $("#estadoEValvula").val("H0");
                    $("#btnActivaElValv").show();
                }
                if(dataPointJson.f==="F1"){
                    $("#estadoF").val("F1");
                }
                else{
                    $("#estadoF").val("F0");
                }
                setTimeout ("consultaEstadoMotor()", 5000); 
                //consultaEstadoMotor();
                console.debug(dataPointJson);                                                                  
            },
            error:function (err){
                console.debug(err);
            }
        });
 }
 var timeCond="";
 var g1;
 function consultaConductividad(){
    $.ajax({
        url: "<?php echo Yii::app()->baseUrl?>/charts/muestraPuntoConductividad",                        
        dataType:"json",
        type: "post",
        async:true,
        //beforeSend:function (){Loading.show();},
        success: function(dataPointJson){
            if(timeCond!==dataPointJson.time){
                timeCond=dataPointJson.time
                g1.refresh(dataPointJson.conductividad);
                setTimeout ("consultaConductividad()", 5000); 
            }                                                               
        },
        error:function (err){
            console.debug(err);
        }
    });
 }
$(document).ready(function () { 
   //setInterval(function() {   
       consultaEstadoMotor();
       g1 = new JustGage({
          id: "g1",
          value: 0,
          min: 0,
          max: 100,
          title: "CONDUCTIVIDAD",
          label: "porciento"
        });
        
        consultaConductividad();
    //},3000);
});
</script>
   