<?php
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl."/css/jqueryTimePicker.css"); 
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/jqueryTimePicker.js",CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile("http://code.highcharts.com/modules/exporting.js",CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile("http://highcharts.github.io/export-csv/export-csv.js",CClientScript::POS_END);
//    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/exportCsvXls.js",CClientScript::POS_HEAD);
?>
<div class="container">
    <div class="row " >
        <div class="span4">
            <form id="formularioHist" name="formularioHist">
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
            </form>
        </div>
       
        <div class="span11">
            <div class="box">
                <div class="box-header">                
                    <h5>Gráfico</h5>
                </div>
                <div class="box-content" >  
                    <div id="g1"></div>   
                </div>
            </div>
            <div class="box">
                <div class="box-header">                
                    <h5>Exportar</h5>
                </div>
                <div class="box-content" >  
                     <input type="button" id="exportaExcel" name="exportaExcel" value="Exportar a excel" onclick="js:exportExcel();">
                     <input type="button" id="exportaCsv" name="exportaCsv" value="Exportar a csv" onclick="js:exportCsv();">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var datosExport=[];
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
    
    
    function exportCsv(){
        if(datosExport!=""){
//              JSONToCSVConvertor(datosExport, true);
            JSONToCSVConvertor(datosExport,$("#variablesSelect :selected").text()+" vs tiempo", true);
        }
        else{
            notif({
            type: "warning",
                msg:"No ha creado un gráfico para poder exportar los datos",
                position: "right",
                width: 500,
                height: 60,
                clickable: true,
                autohide: true
            });
        }
        
    }
    
   
   function exportExcel(){
        if(datosExport!=""){
//              JSONToCSVConvertor(datosExport, true);
            JSONToXLSConvertor(datosExport,$("#variablesSelect :selected").text()+" vs tiempo", true);
        }
        else{
            notif({
            type: "warning",
                msg:"No ha creado un gráfico para poder exportar los datos",
                position: "right",
                width: 500,
                height: 60,
                clickable: true,
                autohide: true
            });
        }
        
    }
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
        datosExport=[{
           magnitud:$("#variablesSelect :selected").text(),
           time:"Tiempo"
        }];
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
                                   datoExport={
                                        magnitud:value.magnitud,
                                        time:value.tempbd
                                     };
                                   datosExport.push(datoExport);
//                                   console.debug(value.time);
//                                   console.debug(value.magnitud);
                                    var d=new Date(value.time);
                                    data.push({
                                        x: (d).getTime(),
                                        y: value.magnitud
                                    });
                               });
                               console.debug(datosExport);
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
                }]
            }); 
        }
        
    }
    function JSONToCSVConvertor(JSONData, ReportTitle, ShowLabel) {
        //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
        
        
            console.debug(JSONData);
        var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;
        var CSV = '';    
        //Set Report title in first row or line

        CSV += ReportTitle + '\r\n\n';

        //This condition will generate the Label/Header
        if (ShowLabel) {
            var row = "";

            //This loop will extract the label from 1st index of on array
            for (var index in arrData[0]) {

                //Now convert each value to string and comma-seprated
                row += index + ',';
            }

            row = row.slice(0, -1);

            //append Label row with line break
            CSV += row + '\r\n';
        }

        //1st loop is to extract each row
        for (var i = 0; i < arrData.length; i++) {
            var row = "";

            //2nd loop will extract each column and convert it in string comma-seprated
            for (var index in arrData[i]) {
                row += '"' + arrData[i][index] + '",';
            }

            row.slice(0, row.length - 1);

            //add a line break after each row
            CSV += row + '\r\n';
        }

        if (CSV == '') {        
            alert("Invalid data");
            return;
        }   

        //Generate a file name
        var fileName = "MyReport_";
        //this will remove the blank-spaces from the title and replace it with an underscore
        fileName += ReportTitle.replace(/ /g,"_");   

        //Initialize file format you want csv or xls
        var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);

        window.open( uri,ReportTitle);
    }
    
    function JSONToXLSConvertor(JSONData, ReportTitle, ShowLabel) {
        //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
        
        
            console.debug(JSONData);
        var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;
        var CSV = '';    
        //Set Report title in first row or line

        CSV += ReportTitle + '\r\n\n';

        //This condition will generate the Label/Header
        if (ShowLabel) {
            var row = "";

            //This loop will extract the label from 1st index of on array
            for (var index in arrData[0]) {

                //Now convert each value to string and comma-seprated
                row += index + ',';
            }

            row = row.slice(0, -1);

            //append Label row with line break
            CSV += row + '\r\n';
        }

        //1st loop is to extract each row
        for (var i = 0; i < arrData.length; i++) {
            var row = "";

            //2nd loop will extract each column and convert it in string comma-seprated
            for (var index in arrData[i]) {
                row += '"' + arrData[i][index] + '",';
            }

            row.slice(0, row.length - 1);

            //add a line break after each row
            CSV += row + '\r\n';
        }

        if (CSV == '') {        
            alert("Invalid data");
            return;
        }   

        //Generate a file name
        var fileName = "MyReport_";
        //this will remove the blank-spaces from the title and replace it with an underscore
        fileName += ReportTitle.replace(/ /g,"_");   

        //Initialize file format you want csv or xls
        var uri = 'data:text/vnd.ms-excel;charset=utf-8,' + escape(CSV);
        window.open( uri,ReportTitle);
    }
</script>