

	<script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/highcharts-more.js"></script>
        <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
        <script src="<?php echo Yii::app()->baseUrl?>/js/charts/raphael-2.1.4.min.js"></script>
        <script src="<?php echo Yii::app()->baseUrl?>/js/charts/justgage.js"></script>
        
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/js/jquery.thermometer.js"></script>
<!--        <div class="row " >
            <div class="span-6 img-rounded" style="border: 1px solid #888888;" >
                BUTTONS
            </div> 
        </div>-->
<hr>        
<div class="row">
    <div class="span-6 img-rounded" style="border: 1px solid #888888;" >
        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto;width:400px"></div>
    </div>        
    <div class="span-6 img-rounded" style="border: 1px solid #888888; width: 15em">
        <div id="g1" ></div>
    </div>
    <div class="span-6 img-rounded" style="border: 1px solid #888888;  padding: 20px 20px 20px 20px;" >
        <div><h4>HUMEDAD</h4></div>
        <div><h2 id="valorHumedad"></h2></div>
        <div id="humedad"></div>
    </div>
    <div class="span-6 img-rounded" style="border: 1px solid #888888;" >
        
        <div id="ph" style="min-width: 210px; max-width: 300; height: 200px; margin: 0 auto" >bla</div>
        <div class="span-6 img-rounded" style="border: 1px solid #888888;  padding: 20px 20px 20px 20px;" >
            <div><div><span style=" background-color: #55BF3B">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> -Ácido </div></div>
            <div><div><span style=" background-color: #DDDF0D">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> -Neutro</div></div>
            <div><div><span style=" background-color: #DF5353">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> -Alcalino</div></div>        
        </div>
        
    </div>
</div>
     

<script>
$(function () {
    $(document).ready(function () {
           var g1 = new JustGage({
          id: "g1",
          value: 0,
          min: 0,
          max: 100,
          title: "CONDUCTIVIDAD",
          label: "porciento"
        });
        var timeCond="";
        setInterval(function() {
            $.ajax({
                    url: "muestraPuntoConductividad",                        
                    dataType:"json",
                    type: "post",
                    async:true,
                    //beforeSend:function (){Loading.show();},
                    success: function(dataPointJson){
                        if(timeCond!==dataPointJson.time){
                            timeCond=dataPointJson.time
                            g1.refresh(dataPointJson.conductividad)
                        }
                                                                   
                    },
                    error:function (err){
                        console.debug(err);
                    }
                });
          //g1.refresh(getRandomInt(50, 100));         
        }, 3000);
        function blendColors(c0, c1, p) {
                var f=parseInt(c0.slice(1),16),t=parseInt(c1.slice(1),16),R1=f>>16,G1=f>>8&0x00FF,B1=f&0x0000FF,R2=t>>16,G2=t>>8&0x00FF,B2=t&0x0000FF;
                return "#"+(0x1000000+(Math.round((R2-R1)*p)+R1)*0x10000+(Math.round((G2-G1)*p)+G1)*0x100+(Math.round((B2-B1)*p)+B1)).toString(16).slice(1);
        }

        $('#humedad').thermometer( {
                startValue: 0,
                height: 150,
                width: "100%",
                bottomText: "0%",
                topText: "100%",
                animationSpeed: 300,
                maxValue: "100",
                minValue: "0",
                pathToSVG: "<?php echo Yii::app()->baseUrl?>/svg/thermo-bottom.svg",
                valueChanged: function(value) {
                        $('#valorHumedad').text(value.toFixed(2)+" %");
                },
                liquidColour: function( value ) {
                        return blendColors("#ff7700","#ff0000", value / 8); 
                },
        });
        var timeHumedad="";
        window.setInterval( function() {                                      
                $.ajax({
                    url: "muestraPuntoHumedad",                        
                    dataType:"json",
                    type: "post",
                    async:true,
                    //beforeSend:function (){Loading.show();},
                    success: function(dataPointJson){
                        if(timeHumedad!==dataPointJson.time){
                            timeHumedad=dataPointJson.time
                            y = dataPointJson.humedad;
                            $('#humedad').thermometer( 'setValue', y );
                        }
                                                                   
                    },
                    error:function (err){
                        console.debug(err);
                    }
                });

        }, 3000 );

        
        
        
        
        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });
    $('#ph').highcharts({

        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
        },

        title: {
            text: "PH"
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
            max: 14,

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
            title: {
                text: 'PH'
            },
            plotBands: [{
                from: 0,
                to: 7,
                color: '#55BF3B' // green
            }, {
                from: 7,
                to: 8,
                color: '#DDDF0D' // yellow
            }, {
                from: 8,
                to: 14,
                color: '#DF5353' // red
            }]
        },

        series: [{
            name: 'PH',
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
                $.ajax({
                    url: "muestraPuntoPh",
                    //url: "muestraPunto",                        
                    dataType:"json",
                    type: "post",
                    async:false,
                    //beforeSend:function (){Loading.show();},
                    success: function(dataPh){  
                        ph=dataPh.ph;
                        console.debug(dataPh);
                    },
                    error:function (err){
                        console.debug(err);
                    }
                });
                var point = chart.series[0].points[0]
                var newVal = Math.floor((Math.random() * 14));
                point.update(ph);
            }, 3000);
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
                                url: "muestraPuntoTemperatura",
                                //url: "muestraPunto",                        
                                dataType:"json",
                                type: "post",
                                async:false,
                                //beforeSend:function (){Loading.show();},
                                success: function(dataPointJson){  
                                    if(timeTemp!==dataPointJson.time){
                                        var x = dataPointJson.time, // current time
                                        y = dataPointJson.temp;
                                        series.addPoint([x, y], true, true);
                                        time=dataPointJson.time;
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
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: 'Temperatura'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br/>' +
                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
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
                    var data = [],
                        time = (new Date()).getTime(),
                        i=-19;
                    $.ajax({
                        url: "muestraArrayTemperatura",    
                        //url: "muestraArrayPuntos",                        
                        dataType:"json",
                        type: "post",
                        async:false,
                        //beforeSend:function (){Loading.show();},
                        success: function(dataJson){  
                            timeTemp=dataJson.punto;
                           $.each(dataJson.puntos,function(key,value){ 
                                
                                data.push({
                                    //x: time + i * 1000,
                                    x: value.time,
                                    y: value.temp
                                });
                                i++;
                           });
                           
                        },
                        error:function (err){
                            console.debug(err);
                        }
                    });  //console.debug(data);
                           return data;
//                    for (i = -19; i <= 0; i += 1) {
//                                data.push({
//                                    x: time + i * 1000,
//                                    y: Math.random()
//                                });
//                            }
//                           console.debug(data);
//                            return data;
                }())
            }]
        });
       
    });
    
});
</script>
	