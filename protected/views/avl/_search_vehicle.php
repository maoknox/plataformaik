<?php
    Yii::app()->clientScript->registerCssFile("https://npmcdn.com/leaflet@1.0.0-rc.2/dist/leaflet.css");
    Yii::app()->clientScript->registerScriptFile("https://npmcdn.com/leaflet@1.0.0-rc.2/dist/leaflet.js",CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/charts/charts.css');
    Yii::app()->clientScript->registerCssFile('http://github.hubspot.com/odometer/themes/odometer-theme-car.css');
    Yii::app()->clientScript->registerCssFile("https://npmcdn.com/leaflet@1.0.0-rc.2/dist/leaflet.css"); 
    Yii::app()->clientScript->registerScriptFile("https://code.highcharts.com/highcharts.js",CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile("https://code.highcharts.com/highcharts-more.js",CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile("https://code.jquery.com/ui/1.10.4/jquery-ui.min.js",CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/charts/raphael-2.1.4.min.js",CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/charts/justgage.js",CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/jquery.thermometer.js",CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/charts/mscorlib.js",CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/charts/PerfectWidgets.js",CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile("https://npmcdn.com/leaflet@1.0.0-rc.2/dist/leaflet.js",CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile("http://github.hubspot.com/odometer/odometer.js",CClientScript::POS_HEAD);
?>
<section class="nav nav-page" >
    <div class="container">
            <div class="span7">
                <header class="page-header">
                    </br>
                    
                        Módulo AVL
                    
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


<!--<link rel="stylesheet" href="https://npmcdn.com/leaflet@1.0.0-rc.2/dist/leaflet.css" />-->
   <div class='container'> 
        <div class="row">
            <div class="span3">
                <div class="blockoff-right">
                    Vehículos
                    <hr>

                </div>
            </div>
            <div class="span12">
                <div class="span8">
                    <div class="box">                 
                        <div id='map' style="height: 400px"></div>  
                    </div>
                </div>
                <div class="span4">
                    <div class="box">
                        <div class="box-header">                
                            <h5>Velocidad</h5>
                        </div>
                        <div class="box-content" >  
                            <div id="velocidadVehiculo" style="min-width: 210px; max-width: 300px; height: 200px; margin: 0 auto" >bla</div>
                        </div>
                    </div>
                </div>
                    
                <div class="span4">
                    <div class="box">
                        <div class="box-header">                
                            <h5>Odometro</h5>
                        </div>
                        <div class="box-content" >  
                            <div id="odometer" style="font-size: 60px; line-height: 50px" class="odometer" >99</div>
                            <?php echo CHtml::hiddenField("valOdometer",99,array("id"=>'valOdometer')) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="span15">
                <div class="box">
                    <div class="box-content">
                        <div class="btn-group-box">
                            <button class="btn"><i class="icon-dashboard icon-large"></i><br/>Dashboard</button>
                            <button class="btn"><i class="icon-user icon-large"></i><br/>Account</button>
                            <button class="btn"><i class="icon-search icon-large"></i><br/>Search</button>
                            <button class="btn"><i class="icon-list-alt icon-large"></i><br/>Reports</button>
                            <button class="btn"><i class="icon-bar-chart icon-large"></i><br/>Charts</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
<!--<script src="https://npmcdn.com/leaflet@1.0.0-rc.2/dist/leaflet.js"></script>-->
<script>
$(document).ready(function () {
    
    /*
     * 
     * odometro
     */
    
    
    setInterval(function () {
        var odometerSum= parseInt($("#valOdometer").val()) ;
        odometerSum+=1;
        odometer.innerHTML=odometerSum;
        console.debug(odometerSum);
        $("#valOdometer").val(odometerSum);
    }, 5000);
    
    /*
     * 
     * fin odometro
     */
    
    /*
    * velocidad
    */
    $('#velocidadVehiculo').highcharts({
            chart: {
                type: 'gauge',
                plotBackgroundColor: null,
                plotBackgroundImage: null,
                plotBorderWidth: 0,
                plotShadow: false
            },
            title: {
                text: "Kms/h"
            },
            pane: {
                startAngle: -150,
                endAngle: 150,
                background: [{
                    backgroundColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                        stops: [
                            [0, '#FFF'],
                            [1, '#333']
                        ]
                    },
                    borderWidth: 0,
                    outerRadius: '109%'
                }, {
                    backgroundColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                        stops: [
                            [0, '#333'],
                            [1, '#FFF']
                        ]
                    },
                    borderWidth: 1,
                    outerRadius: '107%'
                }, {
                    // default background
                }, {
                    backgroundColor: '#DDD',
                    borderWidth: 0,
                    outerRadius: '105%',
                    innerRadius: '103%'
                }]
            },
            // the value axis
            yAxis: {
                min: 0,
                max: 240,
                minorTickInterval: 'auto',
                minorTickWidth: 1,
                minorTickLength: 10,
                minorTickPosition: 'inside',
                minorTickColor: '#666',
                tickPixelInterval: 30,
                tickWidth: 2,
                tickPosition: 'inside',
                tickLength: 10,
                tickColor: '#666',
                labels: {
                    step: 2,
                    rotation: 'auto'
                },
//                title: {
//                    text: 'PH'
//                },
//                plotBands: [{
//                    from: 0,
//                    to: 7,
//                    color: '#55BF3B' // green
//                }, {
//                    from: 7,
//                    to: 8,
//                    color: '#DDDF0D' // yellow
//                }, {
//                    from: 8,
//                    to: 14,
//                    color: '#DF5353' // red
//                }]
            },
            series: [{
                name: 'Velocidad',
                data: [0],
                tooltip: {
                    valueSuffix: ' '
                }
            }]
        },function (chart) {
            if (!chart.renderer.forExport) {
                var timeph;
                var ph;
                setInterval(function () {
                   
                    var point = chart.series[0].points[0]
                    var newVal = Math.floor((Math.random() * 240));
                    point.update(newVal);
                }, 6000);
            }
        });
    /*Fin velocidad*/
});
var map = L.map('map').setView([<?php echo $localization->latitude?>,<?php echo $localization->longitude?>], 15);
L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFva25veCIsImEiOiJmcGJNR09jIn0.d8dHV-Ucm_dxJRbt50d1wA', {
        maxZoom:20,
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
                '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="http://mapbox.com">Mapbox</a>',
        id: 'mapbox.streets'
}).addTo(map);
var puntoUbic=L.marker([<?php echo $localization->latitude?>,<?php echo $localization->longitude?>]);
puntoUbic.addTo(map).bindPopup("<b><?php echo $localization->localization_time;?></b><br />Posición actual.").openPopup();
function onMapClick(e) {
    popup = L.popup();
    popup.setLatLng(e.latlng)
    .setContent("Latitud y longitud en la cual hizo click " + e.latlng.toString())
    .openOn(map);
}
map.on('click', onMapClick);
function creaPunto(){			
    $.ajax({
            url: "muestrapunto",
            dataType:'json',
            type:'post',
            data: 'idVehiculo=1',
       success: function(data) {
             punto=[data.latitud, data.longitud];
             //$("#velocidad").html(data.velocidad);
             //alert(punto);
             map.removeLayer(puntoUbic);	
             puntoUbic=L.marker(punto);
             map.panTo(new L.LatLng(data.latitud, data.longitud));
             puntoUbic.addTo(map).bindPopup("<b>"+data.time+"</b><br />Posición actual.").openPopup();//.openPopup();	
       },
        error: function(xhr, ajaxOptions, thrownError) {
              console.debug(xhr.responseText);
       }
    });    	
}
setInterval('creaPunto()',5000);
</script>
