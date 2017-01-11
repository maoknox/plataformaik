<?php
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl."/css/jqueryTimePicker.css"); 
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/jqueryTimePicker.js",CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile("http://code.highcharts.com/modules/exporting.js",CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile("http://highcharts.github.io/export-csv/export-csv.js",CClientScript::POS_END);
    

    
    
?>
<div class="container">
    <div class="row " >
        <form id="formularioHist" name="formularioHist">
            <div class="span4">
                <div class="box">
                    <div class="box-header">                
                        <h5>Variables</h5>
                    </div>
                    <div class="box-content" >  
                        <select id="variablesSelect" name="ConsHist[variablesSelect]">
                            <option value="">Seleccione...</option>
                            <option value="1">Temperatura</option>
                            <option value="2">Humedad</option>
                            <option value="3">Presión barométrica</option>
                            <option value="4">Velocidad del viendo</option>
                            <option value="5">Precipitación</option>
                        </select>
                    </div>
                </div> 

                <div class="box">
                    <div class="box-header">                
                        <h5>Fecha inicial</h5>
                    </div>
                    <div class="box-content" >  
                        <input type="tex" id="fechaInicial" name="ConsHist[fecha_inicial]">
                    </div>
                </div>
                 <div class="box">
                    <div class="box-header">                
                        <h5>Fecha final</h5>
                    </div>
                    <div class="box-content" >  
                        <input type="tex" id="fechaFinal" name="ConsHist[fecha_final]">
                    </div>
                </div>
                 <div class="box">
                    <div class="box-content" >  
                        <input type="button" id="consulta" name="consulta" value="Consultar" onclick="js:enviaDatos();">
                    </div>
                </div>
            </div>
        </form>
        <div class="span11">
            <div class="box">
                <div class="box-header">                
                    <h5>Gráfico</h5>
                </div>
                <div class="box-content" >  
                    <div id="g1"></div>   
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function (){
        $("#formularioHist").validate({
            rules: {
                "ConsHist[variablesSelect]": "required",
                "ConsHist[fecha_inicial]":"required",
                "ConsHist[fecha_final]":"required"
            },
            messages: {
                "ConsHist[variablesSelect]": "Seleccione una variable",
                "ConsHist[fecha_inicial]":"Seleccione una fecha inicial",
                "ConsHist[fecha_final]":"Seleccione una fecha final"
            }
        });
        $('#fechaInicial').datetimepicker({
            controlType: 'select',
            timeFormat: 'HH:mm:ss',
            dateFormat: "yy-mm-dd"
        });
        $('#fechaFinal').datetimepicker({
            controlType: 'select',
            timeFormat: 'HH:mm:ss',
            dateFormat: "yy-mm-dd"
        });
    });
    
    function enviaDatos(){
//        notif({
//            type: "error",
//            msg:"Mensaje",
//            position: "center",
//            width: 500,
//            height: 60,
//            clickable: true,
//            autohide: true
//        });
       
//               return false;          
        if ($("#formularioHist").valid()) {
            $('#g1').highcharts({
                chart: {
                    defaultSeriesType: 'spline',
                    animation: Highcharts.svg, // don't animate in old IE
                    marginRight: 10,
                    
                },
                plotOptions: {
                    spline: {
                        turboThreshold: 9000,
                        lineWidth: 2,
                        states: {
                            hover: {
                                enabled: true,
                                lineWidth: 3
                            }
                        },
                        marker: {
                            enabled: false,
                            states: {
                                hover: {
                                    enabled : true,
                                    radius: 5,
                                    lineWidth: 1
                                }
                            }  
                        }      
                    }
                },
                title: {
                    text: $("#variablesSelect :selected").text()+' vs Tiempo'
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150
                },
                yAxis: {
                    title: {
                        text: $("#variablesSelect :selected").text()
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
                    enabled: true
                },
                series: [{
                    name: $("#variablesSelect :selected").text()+' vs Tiempo',
                    data: (function () {
                        var dataPost=$("#formularioHist").serialize();
                        // generate an array of random data
                        var data = [],time = (new Date()).getTime(),i = -19;
                        $.ajax({
                            url: "<?php echo Yii::app()->baseUrl?>/charts/muestraHistorico",    
                            //url: "muestraArrayPuntos",                        
                            dataType:"json",
                            data:dataPost,
                            type: "post",
                            async:false,
                            //beforeSend:function (){Loading.show();},
                            success: function(dataJson){
                                
                               $.each(dataJson.datos,function(key,value){ 
                                   console.debug(value.time);
                                   console.debug(value.magnitud);
                                    var d=new Date(value.time);
                                    data.push({
                                        x: (d).getTime(),
                                        y: value.magnitud
                                    });
                               });
                               
                            },
                            error:function (err){
                                console.debug(err);
                            }
                        }); 
                        return data;
//                        for (i = -19; i <= 0; i += 1) {
//                            var dTime=time + i * 1000;
//                            console.debug(new Date(dTime));
//                                    data.push({
//                                        x:dTime,
//                                        y: Math.random()
//                                    });
//                                }
//                               console.debug(data);
//                                return data;
                    }())
                }],
            }); 
        }
        
    }
</script>