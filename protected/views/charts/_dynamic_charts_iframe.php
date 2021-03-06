
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>


<div id="container" style="min-width: 310px; height: 300px; margin: 0 auto"></div>

<script>
$(function () {
    $(document).ready(function () {
        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });
        var timeTemp;
        $('#container').highcharts({
            
            chart: {
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10,
                events: {
                    load: function () {
                        // set up the updating of the chart each second
                        var series = this.series[0];
                        setInterval(function () {                           
                            $.ajax({
                                url: "<?php echo Yii::app()->baseUrl?>/charts/muestraPuntoTemperatura",                        
                                dataType:"json",
                                type: "post",
                                async:false,
                                //beforeSend:function (){Loading.show();},
                                success: function(dataPointJson){  
                                    if(timeTemp!==dataPointJson.time){
                                        var x = dataPointJson.time, // current time
                                        y = dataPointJson.temp;
                                        series.addPoint([x, y], true, true);
                                        timeTemp=dataPointJson.time;
                                    }
                                    console.debug(dataPointJson);
                                },
                                error:function (err){
                                    console.debug(err);
                                }
                            });
                              
                        }, 5000);
                    }
                }
            },
            title: {
                text: 'Temperatura vs Tiempo'
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 50,
                gridLineWidth: 1,                               
            },
            yAxis: {
                title: {
                    text: 'Temperatura (°C)'
                },                              
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br/> Tiempo: ' +
                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/> Temperatura(°C): ' +
                        Highcharts.numberFormat(this.y, 2);
                }
            },
            legend: {
                enabled: true
            },
            exporting: {
                enabled: false
            },
            series: [{
                name: 'T vs H',
                data: (function () {
                    // generate an array of random data
                    var data = []
                    $.ajax({
                        url: "<?php echo Yii::app()->baseUrl?>/charts/muestraArrayTemperatura",                        
                        dataType:"json",
                        type: "post",
                        async:false,
                        //beforeSend:function (){Loading.show();},
                        success: function(dataJson){  
                            timeTemp=dataJson.punto;
                           $.each(dataJson.puntos,function(key,value){ 
                               console.debug(value.time+" "+value.temp+" "+value.tempbd);
                                
                                data.push({                                 
                                    //x: time + i * 1000,
                                    x: value.time,
                                    y: value.temp
                                });                              
                           });
                           
                        },
                        error:function (err){
                            console.debug(err);
                        }
                    });  //console.debug(data);
                           return data;                    
                }())
            }]
        });
    });
});
</script>
	