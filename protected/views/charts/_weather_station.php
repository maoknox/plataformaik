<?php
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/charts/charts.css');
   Yii::app()->clientScript->registerCssFile("https://npmcdn.com/leaflet@1.0.0-rc.2/dist/leaflet.css"); 
    Yii::app()->clientScript->registerScriptFile("https://code.highcharts.com/highcharts.js",CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile("https://code.highcharts.com/highcharts-more.js",CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/charts/raphael-2.1.4.min.js",CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/charts/justgage.js",CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/charts/mscorlib.js",CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/charts/PerfectWidgets.js",CClientScript::POS_HEAD);
    Yii::app()->clientScript->registerScriptFile("https://npmcdn.com/leaflet@1.0.0-rc.2/dist/leaflet.js",CClientScript::POS_HEAD);
?>
<section class="nav nav-page" >
    <div class="container" >
            <div class="span7">
                <header class="page-header">
                    </br>
                    
                        Módulo Meteorología-Estación metereológica
                    
                </header>
            </div>
            <div class="page-nav-options">
                <div class="span9">
                    <ul class="nav nav-pills">
                        <li>
                            <a href="<?php echo Yii::app()->baseUrl; ?>"><i class="icon-home icon-large"></i></a>
                        </li>
                    </ul>
                    <ul class="nav nav-tabs">
                        <li>
                            <?php 
                                echo CHtml::link('Gráficos', '#', array(
                                    'onclick'=>'$("#jobDialog").dialog("open"); return false;',
                                 ));
                            ?>
                        </li>
<!--                        <li>
                            <?php 
//                                echo CHtml::link('Estadísticas', '#', array(
//                                    'onclick'=>'$("#estadisticaWs").dialog("open"); return false;',
//                                 ));
                            ?>
                        </li>-->
                    </ul>
                </div>
            </div>
    </div>
</section>
<div class="container">   
    <div class="row">
        <div class="span4">
            <div class="box">
                <div class="box-header">
                    <h5>Dirección del viento</h5>
                </div>
            </div>
            <div  class="img-rounded subcontiner">                    
                <div id="root"></div>
            </div>
        </div>
        <div class="span4">
            
                <div class="span4">
                    <div class="box">
                        <div class="box-header">
                            <h5>Velocidad (mts/s)</h5>
                        </div>
                        <div  class="img-rounded subcontainerText">                    
                            <div id="divVelViento" class="scoreBoard"></div>
                        </div>
                    </div>
                </div>
                <div class="span4">
                    <div class="box">
                        <div class="box-header">
                            <h5>Lluvia (ml/h)</h5>
                        </div>
                        <div  class="img-rounded subcontainerText">                    
                            <div id="divVelLluvia" class="scoreBoard"></div>
                        </div>
                    </div>
                </div>
            
        </div>
        <div class="span4">
            <div class="box">
                <div class="box-header">
                    <h5>Conductividad (%)</h5>
                </div>
            </div>
            <div class="img-rounded subcontiner" >                    
                <div id="conductividad" ></div>
            </div>
        </div>
        <div class="span4">
            <div class="box">
                <div class="box-header">                
                    <h5>Humedad (%)</h5>
                </div>
            </div>
            <div class="img-rounded subcontiner" >                    
                <div id="humedadDiv"></div>
            </div>
        </div>
    </div><div class="row">
        <div class="span8">
            <div class="box">
                <div class="box-header">
                    <h5>Temperatura</h5>
                </div>
            </div>
            <div id="temperatura" class="img-rounded subcontiner" >                    

            </div>
        </div>
        <div class="span7">
            <div class="box">
                <div class="box-header">
                    <h5>Ubicación</h5>
                </div>
            </div>
            <div class="img-rounded subcontiner" >                    
                <div id="map" style="height: 300px"></div>
            </div>
        </div>
    </div>
</div>
<?php 
    $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
        'id'=>'jobDialog',
        'options'=>array(
            'title'=>Yii::t('job','Consultar históricos'),
            'autoOpen'=>false,
            'modal'=>'false',
            'width'=>'auto',
            'height'=>'600',
            'zIndex'=> 10000,
        ),
    ));
echo $this->renderPartial('_graficosws', false, true); ?>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>
<?php 
    $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
        'id'=>'estadisticaWs',
        'options'=>array(
            'title'=>Yii::t('job','Consultar históricos'),
            'autoOpen'=>false,
            'modal'=>'false',
            'width'=>'auto',
            'height'=>'600',
            'zIndex'=> 10000,
        ),
    ));
echo $this->renderPartial('_estadisticaWs',array("args"=>'args'), true); ?>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>
<div id="downloadFile"></div>
<script>
    
    $(function () {
        $(document).ready(function () {
		Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });
            /*
             * velocidad del viento y nivel de lluvia
             */
           
            setInterval(function() {
                /*
                 * Consulta velocidad viento
                 */
                $.ajax({
                    url: "<?php echo Yii::app()->baseUrl?>/charts/muestraVelViento",
                    //url: "muestraPunto",                        
                    dataType:"json",
                    type: "post",
                    async:true,
                    //beforeSend:function (){Loading.show();},
                    success: function(dataVV){  
                        velViento=dataVV.velViento;
                        console.debug("velocidadViento----"+(velViento).toFixed(2));
                        $("#divVelViento").text(dataVV.velViento);//(velViento).toFixed(2)
                    },
                    error:function (err){
                        console.debug(err);
                    }
                });
                //g1.refresh(getRandomInt(50, 100));         
            }, 5000);
            
            setInterval(function() {
                /*
                 * Consulta lluvia
                 */
                $.ajax({
                    url: "<?php echo Yii::app()->baseUrl?>/charts/muestraLluvia",
                    //url: "muestraPunto",                        
                    dataType:"json",
                    type: "post",
                    async:true,
                    //beforeSend:function (){Loading.show();},
                    success: function(dataLl){  
                        lluvia=dataLl.lluvia;
                        console.debug("lluvia----"+lluvia);
                        $("#divVelLluvia").text(dataLl.lluvia);
                    },
                    error:function (err){
                        console.debug(err);
                    }
                });
                //g1.refresh(getRandomInt(50, 100));         
            }, 5000);
            /*
             * fin velocidad de viento y nivel de lluvia
             */
            /*brújula-compass*/
            var slider;
            var slider2;
            var jsonModel = {"Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":null,"JSBindingsText":null,"Name":"Instrument","RecalculateAll":false,"Smooth":true,"Stroke":{"__type":"SimpleStroke:#PerpetuumSoft.Framework.Drawing","Width":1,"Color":{"knownColor":35,"name":null,"state":1,"value":0},"DashLenght":5,"DotLenght":1,"SpaceLenght":2,"Style":1},"Style":"Default","ToolTipValue":null,"Visible":true,"Elements":[{"__type":"Circle:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":{"__type":"LinearGradientFill:#PerpetuumSoft.Framework.Drawing","Angle":90,"Colors":[{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":35,"name":null,"state":1,"value":0},"Portion":0},{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4289901234},"Portion":1}],"EndColor":{"knownColor":0,"name":null,"state":2,"value":4289901234},"StartColor":{"knownColor":35,"name":null,"state":1,"value":0}},"JSBindingsText":"this.setCenter(new PerfectWidgets.Framework.DataObjects.Vector((this.getInstrument().getByName('Instrument') .getSize() .getWidth()\/2),(this.getInstrument().getByName('Instrument') .getSize() .getHeight()\/2)).add(new PerfectWidgets.Framework.DataObjects.Vector(0,112.5)));\u000a","Name":"Circle1","RecalculateAll":false,"Smooth":true,"Stroke":{"__type":"SimpleStroke:#PerpetuumSoft.Framework.Drawing","Width":5,"Color":{"knownColor":35,"name":null,"state":1,"value":0},"DashLenght":5,"DotLenght":1,"SpaceLenght":2,"Style":1},"Style":"Circle1","ToolTipValue":null,"Visible":true,"Center":{"Height":862.5,"Length":1072.5262234556319,"Rotation":0.93428811100694553,"Width":637.5,"X":637.5,"Y":862.5},"Radius":618.75},{"__type":"Circle:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":{"__type":"MultiGradientFill:#PerpetuumSoft.Framework.Drawing","Angle":90,"Colors":[{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4281808695},"Portion":0},{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4293256677},"Portion":0.22},{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":35,"name":null,"state":1,"value":0},"Portion":0.5},{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":35,"name":null,"state":1,"value":0},"Portion":0.78},{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4279589271},"Portion":1}]},"JSBindingsText":"this.setCenter(this.getInstrument().getByName('Circle1') .getCenter());\u000a","Name":"Circle2","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"Circle2","ToolTipValue":null,"Visible":true,"Center":{"Height":862.5,"Length":1072.5262234556319,"Rotation":0.93428811100694553,"Width":637.5,"X":637.5,"Y":862.5},"Radius":593.75},{"__type":"Circle:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":{"__type":"SphericalFill:#PerpetuumSoft.Framework.Drawing","Angle":216,"Colors":[{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4292865771},"Portion":0},{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4278224383},"Portion":1}],"Delta":0.3,"EndColor":{"knownColor":0,"name":null,"state":2,"value":4292865771},"StartColor":{"knownColor":0,"name":null,"state":2,"value":4278224383}},"JSBindingsText":"this.setCenter(this.getInstrument().getByName('Circle1') .getCenter());\u000a","Name":"Circle3","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"Circle3","ToolTipValue":null,"Visible":true,"Center":{"Height":862.5,"Length":1072.5262234556319,"Rotation":0.93428811100694553,"Width":637.5,"X":637.5,"Y":862.5},"Radius":518.75},{"__type":"Star:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":{"__type":"SolidFill:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":2600502783}},"JSBindingsText":"this.setCenter(this.getInstrument().getByName('Circle1') .getCenter());\u000a","Name":"Star1","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"Star1","ToolTipValue":null,"Visible":true,"Angle":0,"Center":{"Height":862.5,"Length":1072.5262234556319,"Rotation":0.93428811100694553,"Width":637.5,"X":637.5,"Y":862.5},"Radius":513.10939379434478,"Sides":4,"InternalRadius":117.92476415070755},{"__type":"Star:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":{"__type":"SolidFill:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":2600502783}},"JSBindingsText":"this.setCenter(this.getInstrument().getByName('Circle1') .getCenter());\u000a","Name":"Star2","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"Star1","ToolTipValue":null,"Visible":true,"Angle":45,"Center":{"Height":862.5,"Length":1072.5262234556319,"Rotation":0.93428811100694553,"Width":637.5,"X":637.5,"Y":862.5},"Radius":309.4854600784987,"Sides":4,"InternalRadius":117.92476415070755},{"__type":"Circle:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":{"__type":"MultiGradientFill:#PerpetuumSoft.Framework.Drawing","Angle":90,"Colors":[{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4281808695},"Portion":0},{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4293256677},"Portion":0.22},{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":35,"name":null,"state":1,"value":0},"Portion":0.5},{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":35,"name":null,"state":1,"value":0},"Portion":0.78},{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4279589271},"Portion":1}]},"JSBindingsText":"this.setCenter(this.getInstrument().getByName('Circle1') .getCenter());\u000a","Name":"Circle6","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"Circle2","ToolTipValue":null,"Visible":true,"Center":{"Height":862.5,"Length":1072.5262234556319,"Rotation":0.93428811100694553,"Width":637.5,"X":637.5,"Y":862.5},"Radius":112.5},{"__type":"Circle:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":{"__type":"SolidFill:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4291355902}},"JSBindingsText":"this.setCenter(this.getInstrument().getByName('Circle1') .getCenter());\u000a","Name":"Circle7","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"Circle7","ToolTipValue":null,"Visible":true,"Center":{"Height":862.5,"Length":1072.5262234556319,"Rotation":0.93428811100694553,"Width":637.5,"X":637.5,"Y":862.5},"Radius":103.125},{"__type":"Circle:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":{"__type":"MultiGradientFill:#PerpetuumSoft.Framework.Drawing","Angle":90,"Colors":[{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4281808695},"Portion":0},{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4293256677},"Portion":0.22},{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":35,"name":null,"state":1,"value":0},"Portion":0.5},{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":35,"name":null,"state":1,"value":0},"Portion":0.78},{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4279589271},"Portion":1}]},"JSBindingsText":"this.setCenter(this.getInstrument().getByName('Circle1') .getCenter());\u000a","Name":"Circle8","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"Circle2","ToolTipValue":null,"Visible":true,"Center":{"Height":862.5,"Length":1072.5262234556319,"Rotation":0.93428811100694553,"Width":637.5,"X":637.5,"Y":862.5},"Radius":93.75},{"__type":"Highlight:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":{"__type":"SolidFill:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":1694498815}},"JSBindingsText":"this.setCenter(this.getInstrument().getByName('Circle1') .getCenter());\u000athis.setRadius((this.getInstrument().getByName('Circle3') .getRadius()-12.5));\u000a","Name":"Highlight2","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"Highlight1","ToolTipValue":null,"Visible":true,"Angle":168.11,"Center":{"Height":862.5,"Length":1072.5262234556319,"Rotation":0.93428811100694553,"Width":637.5,"X":637.5,"Y":862.5},"Radius":506.25,"K":0.35,"SweepAngle":120},{"__type":"Joint:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":null,"JSBindingsText":"this.setCenter(this.getInstrument().getByName('Circle1') .getCenter());\u000a","Name":"Joint1","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"","ToolTipValue":null,"Visible":true,"Elements":[{"__type":"Scale:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":null,"JSBindingsText":null,"Name":"Scale1","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"","ToolTipValue":null,"Visible":true,"Elements":[{"__type":"RangedLevel:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":{"__type":"SolidFill:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":164,"name":null,"state":1,"value":0}},"JSBindingsText":"this.setDistance((this.getInstrument().getByName('Joint1') .getRadius()-15.625));\u000a","Name":"RangedLevel1","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"RangedLevel1","ToolTipValue":null,"Visible":true,"Colorizer":null,"Distance":381.25,"Dock":0,"MaxLimitWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"MinLimitWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"OriginWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"Padding":0,"ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"Colors":[],"Divisions":72,"DivisionsStroke":{"__type":"SimpleStroke:#PerpetuumSoft.Framework.Drawing","Width":5,"Color":{"knownColor":0,"name":null,"state":2,"value":4278337922},"DashLenght":5,"DotLenght":1,"SpaceLenght":2,"Style":1},"EndColor":{"knownColor":27,"name":null,"state":1,"value":0},"StartColor":{"knownColor":27,"name":null,"state":1,"value":0},"AlignmentMode":0,"EndWidth":31.25,"StartWidth":31.25},{"__type":"ScaleMarks:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":{"__type":"SolidFill:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4278337922}},"JSBindingsText":"this.setDistance(this.getInstrument().getByName('Joint1') .getRadius());\u000a","Name":"ScaleMarks1","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"ScaleMarks1","ToolTipValue":null,"Visible":true,"Colorizer":null,"Distance":396.875,"Dock":0,"MaxLimitWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"MinLimitWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"OriginWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"Padding":0,"Divisions":8,"StepWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"SubDivisions":1,"SubTicksPosition":0,"UseDescreteValues":false,"UseRoundValues":false,"MarksAngle":0,"MarksSize":{"Height":12.5,"Length":106.98276730389806,"Rotation":0.11710874456686428,"Width":106.25,"X":106.25,"Y":12.5},"RotationMode":1,"Shape":{"__type":"RectangleShape:#PerpetuumSoft.Framework.Drawing"},"SubMarksSize":{"Height":9.375,"Length":63.199213800489638,"Rotation":0.14888994760949725,"Width":62.5,"X":62.5,"Y":9.375}},{"__type":"ScaleMarks:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":{"__type":"SolidFill:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4278337922}},"JSBindingsText":"this.setDistance(this.getInstrument().getByName('Joint1') .getRadius());\u000a","Name":"ScaleMarks2","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"ScaleMarks1","ToolTipValue":null,"Visible":true,"Colorizer":null,"Distance":396.875,"Dock":0,"MaxLimitWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"MinLimitWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"OriginWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"Padding":0,"Divisions":36,"StepWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"SubDivisions":1,"SubTicksPosition":0,"UseDescreteValues":false,"UseRoundValues":false,"MarksAngle":0,"MarksSize":{"Height":9.375,"Length":57.025898721545808,"Rotation":0.16514867741462683,"Width":56.25,"X":56.25,"Y":9.375},"RotationMode":1,"Shape":{"__type":"RectangleShape:#PerpetuumSoft.Framework.Drawing"},"SubMarksSize":{"Height":9.375,"Length":63.199213800489638,"Rotation":0.14888994760949725,"Width":62.5,"X":62.5,"Y":9.375}},{"__type":"ScaleLabels:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":null,"JSBindingsText":"this.setDistance((this.getInstrument().getByName('Joint1') .getRadius()-87.5));\u000a","Name":"ScaleLabels1","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"ScaleLabels1","ToolTipValue":null,"Visible":true,"Colorizer":{"__type":"SingleColorColorizer:#PerpetuumSoft.Instrumentation.Model.Drawing","Color":{"knownColor":164,"name":null,"state":1,"value":0}},"Distance":309.375,"Dock":0,"MaxLimitWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":359},"MinLimitWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":1},"OriginWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"Padding":0,"Font":{"Bold":1,"FamilyName":"Arial","Italic":2,"Size":12,"Strikeout":2,"Underline":2},"Format":{"CurrencyNegativePattern":0,"CurrencyPositivePattern":0,"CurrencySymbol":"$","DateSeparator":".","DecimalPlaces":2,"DecimalSeparator":".","FormatMask":"","FormatStyle":0,"GroupSeparator":" ","NumberNegativePattern":0,"PercentNegativePattern":0,"PercentPositivePattern":0,"UseCultureSettings":true,"UseGroupSeparator":true},"Formula":"","ItemMargins":{},"OddLabelsDistance":0,"Position":1,"ShowSuperposableLabels":true,"TextAlignment":1,"TextAngle":90,"TextRotationMode":1,"Divisions":8,"StepWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"UseRoundValues":false},{"__type":"CustomLabels:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":null,"JSBindingsText":"this.setDistance((this.getInstrument().getByName('Joint1') .getRadius()-87.5));\u000a","Name":"CustomLabels1","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"ScaleLabels1","ToolTipValue":null,"Visible":true,"Colorizer":{"__type":"SingleColorColorizer:#PerpetuumSoft.Instrumentation.Model.Drawing","Color":{"knownColor":164,"name":null,"state":1,"value":0}},"Distance":309.375,"Dock":0,"MaxLimitWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"MinLimitWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"OriginWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"Padding":0,"Font":{"Bold":1,"FamilyName":"Arial","Italic":2,"Size":12,"Strikeout":2,"Underline":2},"Format":{"CurrencyNegativePattern":0,"CurrencyPositivePattern":0,"CurrencySymbol":"$","DateSeparator":".","DecimalPlaces":2,"DecimalSeparator":".","FormatMask":"","FormatStyle":0,"GroupSeparator":" ","NumberNegativePattern":0,"PercentNegativePattern":0,"PercentPositivePattern":0,"UseCultureSettings":true,"UseGroupSeparator":true},"Formula":"","ItemMargins":{},"OddLabelsDistance":0,"Position":1,"ShowSuperposableLabels":true,"TextAlignment":1,"TextAngle":90,"TextRotationMode":1,"Labels":[{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"360\/0","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":0}}]},{"__type":"CustomLabels:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":null,"JSBindingsText":"this.setDistance((this.getInstrument().getByName('Joint1') .getRadius()-43.75));\u000a","Name":"CustomLabels2","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"CustomLabels2","ToolTipValue":null,"Visible":true,"Colorizer":{"__type":"SingleColorColorizer:#PerpetuumSoft.Instrumentation.Model.Drawing","Color":{"knownColor":164,"name":null,"state":1,"value":0}},"Distance":353.125,"Dock":0,"MaxLimitWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"MinLimitWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"OriginWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"Padding":0,"Font":{"Bold":1,"FamilyName":"Arial","Italic":2,"Size":6.75,"Strikeout":2,"Underline":2},"Format":{"CurrencyNegativePattern":0,"CurrencyPositivePattern":0,"CurrencySymbol":"$","DateSeparator":".","DecimalPlaces":2,"DecimalSeparator":".","FormatMask":"","FormatStyle":0,"GroupSeparator":" ","NumberNegativePattern":0,"PercentNegativePattern":0,"PercentPositivePattern":0,"UseCultureSettings":true,"UseGroupSeparator":true},"Formula":"","ItemMargins":{},"OddLabelsDistance":0,"Position":1,"ShowSuperposableLabels":true,"TextAlignment":1,"TextAngle":90,"TextRotationMode":1,"Labels":[{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"10","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":10}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"20","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":20}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"30","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":30}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"40","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":40}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"50","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":50}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"60","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":60}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"70","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":70}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"80","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":80}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"100","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":100}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"110","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":110}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"120","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":120}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"130","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":130}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"140","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":140}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"150","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":150}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"160","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":160}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"170","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":170}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"190","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":190}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"200","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":200}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"210","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":210}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"220","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":220}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"230","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":230}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"240","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":240}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"250","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":250}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"260","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":260}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"280","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":280}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"290","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":290}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"300","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":300}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"310","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":310}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"320","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":320}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"330","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":330}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"340","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":340}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"350","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":350}}]},{"__type":"CustomLabels:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":null,"JSBindingsText":"this.setDistance((this.getInstrument().getByName('Joint1') .getRadius()-156.25));\u000a","Name":"CustomLabels5","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"CustomLabels5","ToolTipValue":null,"Visible":true,"Colorizer":{"__type":"SingleColorColorizer:#PerpetuumSoft.Instrumentation.Model.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4278337922}},"Distance":240.625,"Dock":0,"MaxLimitWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"MinLimitWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"OriginWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"Padding":0,"Font":{"Bold":1,"FamilyName":"Times New Roman","Italic":2,"Size":20.25,"Strikeout":2,"Underline":2},"Format":{"CurrencyNegativePattern":0,"CurrencyPositivePattern":0,"CurrencySymbol":"$","DateSeparator":".","DecimalPlaces":2,"DecimalSeparator":".","FormatMask":"","FormatStyle":0,"GroupSeparator":" ","NumberNegativePattern":0,"PercentNegativePattern":0,"PercentPositivePattern":0,"UseCultureSettings":true,"UseGroupSeparator":true},"Formula":"","ItemMargins":{},"OddLabelsDistance":0,"Position":1,"ShowSuperposableLabels":true,"TextAlignment":1,"TextAngle":0,"TextRotationMode":0,"Labels":[{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"N","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":0}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"E","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":90}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"S","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":180}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"W","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":270}}]},{"__type":"CustomLabels:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":null,"JSBindingsText":"this.setDistance((this.getInstrument().getByName('Joint1') .getRadius()-212.5));\u000a","Name":"CustomLabels6","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"CustomLabels6","ToolTipValue":null,"Visible":true,"Colorizer":{"__type":"SingleColorColorizer:#PerpetuumSoft.Instrumentation.Model.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4278337922}},"Distance":184.375,"Dock":0,"MaxLimitWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"MinLimitWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"OriginWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"Padding":0,"Font":{"Bold":1,"FamilyName":"Times New Roman","Italic":2,"Size":14.25,"Strikeout":2,"Underline":2},"Format":{"CurrencyNegativePattern":0,"CurrencyPositivePattern":0,"CurrencySymbol":"$","DateSeparator":".","DecimalPlaces":2,"DecimalSeparator":".","FormatMask":"","FormatStyle":0,"GroupSeparator":" ","NumberNegativePattern":0,"PercentNegativePattern":0,"PercentPositivePattern":0,"UseCultureSettings":true,"UseGroupSeparator":true},"Formula":"","ItemMargins":{},"OddLabelsDistance":0,"Position":1,"ShowSuperposableLabels":true,"TextAlignment":1,"TextAngle":90,"TextRotationMode":1,"Labels":[{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"NW","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":315}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"NE","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":45}}]},{"__type":"CustomLabels:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":null,"JSBindingsText":"this.setDistance((this.getInstrument().getByName('Joint1') .getRadius()-212.5));\u000a","Name":"CustomLabels7","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"CustomLabels6","ToolTipValue":null,"Visible":true,"Colorizer":{"__type":"SingleColorColorizer:#PerpetuumSoft.Instrumentation.Model.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4278337922}},"Distance":184.375,"Dock":0,"MaxLimitWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"MinLimitWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"OriginWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"Padding":0,"Font":{"Bold":1,"FamilyName":"Times New Roman","Italic":2,"Size":14.25,"Strikeout":2,"Underline":2},"Format":{"CurrencyNegativePattern":0,"CurrencyPositivePattern":0,"CurrencySymbol":"$","DateSeparator":".","DecimalPlaces":2,"DecimalSeparator":".","FormatMask":"","FormatStyle":0,"GroupSeparator":" ","NumberNegativePattern":0,"PercentNegativePattern":0,"PercentPositivePattern":0,"UseCultureSettings":true,"UseGroupSeparator":true},"Formula":"","ItemMargins":{},"OddLabelsDistance":0,"Position":1,"ShowSuperposableLabels":true,"TextAlignment":1,"TextAngle":270,"TextRotationMode":1,"Labels":[{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"SE","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":135}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"SW","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":225}}]},{"__type":"Slider:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":null,"JSBindingsText":null,"Name":"Slider1","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"","ToolTipValue":null,"Visible":true,"Elements":[{"__type":"Needle:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":{"__type":"SolidFill:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4278809030}},"JSBindingsText":"this.setEndPoint(this.getInstrument().getByName(\"Slider1\").getPosition((this.getInstrument().getByName('Joint1') .getRadius()*0.76)));\u000athis.setStartPoint(this.getInstrument().getByName(\"Slider1\").getPosition(0));\u000a","Name":"Needle1","RecalculateAll":false,"Smooth":true,"Stroke":{"__type":"SimpleStroke:#PerpetuumSoft.Framework.Drawing","Width":3,"Color":{"knownColor":0,"name":null,"state":2,"value":4278809030},"DashLenght":5,"DotLenght":1,"SpaceLenght":2,"Style":1},"Style":"Needle1","ToolTipValue":null,"Visible":true,"EndPoint":{"Height":837.45140713911587,"Length":1257.5073712354551,"Rotation":0.72878188179021464,"Width":938.08311433061181,"X":938.08311433061181,"Y":837.45140713911587},"StartPoint":{"Height":862.5,"Length":1072.5262234556319,"Rotation":0.93428811100694553,"Width":637.5,"X":637.5,"Y":862.5},"EndWidth":0,"NeedlePoints":[],"ShowMode":0,"StartWidth":93.75},{"__type":"Needle:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":{"__type":"SolidFill:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4294934656}},"JSBindingsText":"this.setEndPoint(this.getInstrument().getByName(\"Slider1\").getPosition((-this.getInstrument().getByName('Joint1') .getRadius()*0.76)));\u000athis.setStartPoint(this.getInstrument().getByName(\"Slider1\").getPosition(0));\u000a","Name":"Needle2","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"Needle2","ToolTipValue":null,"Visible":true,"EndPoint":{"Height":887.54859286088413,"Length":949.3447701117309,"Rotation":1.2079955038935661,"Width":336.91688566938819,"X":336.91688566938819,"Y":887.54859286088413},"StartPoint":{"Height":862.5,"Length":1072.5262234556319,"Rotation":0.93428811100694553,"Width":637.5,"X":637.5,"Y":862.5},"EndWidth":0,"NeedlePoints":[],"ShowMode":0,"StartWidth":93.75},{"__type":"TruncatedEllipse:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":{"__type":"SolidFill:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4278809030}},"JSBindingsText":"this.setCenter(this.getInstrument().getByName('Circle1') .getCenter());\u000athis.setAngle(PerfectWidgets.Framework.DataObjects.Vector.toDegrees(this.getInstrument().getByName('Slider1').getPosition(0).minus(this.getInstrument().getByName('Slider1').getPosition(1)).getRotation()));\u000a","Name":"TruncatedEllipse1","RecalculateAll":false,"Smooth":true,"Stroke":{"__type":"SimpleStroke:#PerpetuumSoft.Framework.Drawing","Width":3,"Color":{"knownColor":0,"name":null,"state":2,"value":4278809030},"DashLenght":5,"DotLenght":1,"SpaceLenght":2,"Style":1},"Style":"Needle1","ToolTipValue":null,"Visible":true,"Center":{"Height":862.5,"Length":1072.5262234556319,"Rotation":0.93428811100694553,"Width":637.5,"X":637.5,"Y":862.5},"Size":{"Height":131.25,"Length":185.61553006146872,"Rotation":0.78539816339744828,"Width":131.25,"X":131.25,"Y":131.25},"Angle":175.24,"StartAngle":90,"SweepAngle":180},{"__type":"TruncatedEllipse:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":{"__type":"SolidFill:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4294934656}},"JSBindingsText":"this.setCenter(this.getInstrument().getByName('Circle1') .getCenter());\u000athis.setAngle(PerfectWidgets.Framework.DataObjects.Vector.toDegrees(this.getInstrument().getByName('Slider1').getPosition(0).minus(this.getInstrument().getByName('Slider1').getPosition(1)).getRotation()));\u000a","Name":"TruncatedEllipse2","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"TruncatedEllipse2","ToolTipValue":null,"Visible":true,"Center":{"Height":862.5,"Length":1072.5262234556319,"Rotation":0.93428811100694553,"Width":637.5,"X":637.5,"Y":862.5},"Size":{"Height":131.25,"Length":185.61553006146872,"Rotation":0.78539816339744828,"Width":131.25,"X":131.25,"Y":131.25},"Angle":175.24,"StartAngle":270,"SweepAngle":180},{"__type":"Circle:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":{"__type":"LinearGradientFill:#PerpetuumSoft.Framework.Drawing","Angle":90,"Colors":[{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4294936969},"Portion":0},{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4280455413},"Portion":1}],"EndColor":{"knownColor":0,"name":null,"state":2,"value":4280455413},"StartColor":{"knownColor":0,"name":null,"state":2,"value":4294936969}},"JSBindingsText":"this.setCenter(this.getInstrument().getByName('Circle1') .getCenter());\u000a","Name":"Circle5","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"Circle5","ToolTipValue":null,"Visible":true,"Center":{"Height":862.5,"Length":1072.5262234556319,"Rotation":0.93428811100694553,"Width":637.5,"X":637.5,"Y":862.5},"Radius":46.875},{"__type":"Highlight:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":{"__type":"SolidFill:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":1694498815}},"JSBindingsText":"this.setCenter(this.getInstrument().getByName('Circle1') .getCenter());\u000athis.setRadius(this.getInstrument().getByName('Circle5') .getRadius());\u000a","Name":"Highlight1","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"Highlight1","ToolTipValue":null,"Visible":true,"Angle":130,"Center":{"Height":862.5,"Length":1072.5262234556319,"Rotation":0.93428811100694553,"Width":637.5,"X":637.5,"Y":862.5},"Radius":46.875,"K":0.35,"SweepAngle":180}],"MaxLimit":{"Kind":0,"Value":0},"MinLimit":{"Kind":0,"Value":0},"Step":0,"Value":85.236358309273882}],"Colorizer":null,"Maximum":360,"Minimum":0,"Reverse":false}],"Margins":{},"Center":{"Height":862.5,"Length":1072.5262234556319,"Rotation":0.93428811100694553,"Width":637.5,"X":637.5,"Y":862.5},"Dock":0,"Radius":396.875,"StartAngle":270,"TotalAngle":360},{"__type":"Joint:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":null,"JSBindingsText":"this.setCenter(this.getInstrument().getByName('Joint1') .getCenter());\u000athis.setRadius(this.getInstrument().getByName('Joint1') .getRadius());\u000a","Name":"Joint2","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"","ToolTipValue":null,"Visible":true,"Elements":[{"__type":"Scale:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":null,"JSBindingsText":null,"Name":"Scale2","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"","ToolTipValue":null,"Visible":true,"Elements":[{"__type":"ScaleLabels:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":null,"JSBindingsText":"this.setDistance((this.getInstrument().getByName('Joint2') .getRadius()+81.25));\u000a","Name":"ScaleLabels1","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"ScaleLabels1","ToolTipValue":null,"Visible":true,"Colorizer":{"__type":"SingleColorColorizer:#PerpetuumSoft.Instrumentation.Model.Drawing","Color":{"knownColor":164,"name":null,"state":1,"value":0}},"Distance":478.125,"Dock":0,"MaxLimitWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":359},"MinLimitWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":1},"OriginWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"Padding":0,"Font":{"Bold":1,"FamilyName":"Arial","Italic":2,"Size":12,"Strikeout":2,"Underline":2},"Format":{"CurrencyNegativePattern":0,"CurrencyPositivePattern":0,"CurrencySymbol":"$","DateSeparator":".","DecimalPlaces":2,"DecimalSeparator":".","FormatMask":"","FormatStyle":0,"GroupSeparator":" ","NumberNegativePattern":0,"PercentNegativePattern":0,"PercentPositivePattern":0,"UseCultureSettings":true,"UseGroupSeparator":true},"Formula":"","ItemMargins":{},"OddLabelsDistance":0,"Position":1,"ShowSuperposableLabels":true,"TextAlignment":1,"TextAngle":90,"TextRotationMode":1,"Divisions":8,"StepWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"UseRoundValues":false},{"__type":"CustomLabels:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":null,"JSBindingsText":"this.setDistance((this.getInstrument().getByName('Joint2') .getRadius()+81.25));\u000a","Name":"CustomLabels3","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"ScaleLabels1","ToolTipValue":null,"Visible":true,"Colorizer":{"__type":"SingleColorColorizer:#PerpetuumSoft.Instrumentation.Model.Drawing","Color":{"knownColor":164,"name":null,"state":1,"value":0}},"Distance":478.125,"Dock":0,"MaxLimitWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"MinLimitWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"OriginWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"Padding":0,"Font":{"Bold":1,"FamilyName":"Arial","Italic":2,"Size":12,"Strikeout":2,"Underline":2},"Format":{"CurrencyNegativePattern":0,"CurrencyPositivePattern":0,"CurrencySymbol":"$","DateSeparator":".","DecimalPlaces":2,"DecimalSeparator":".","FormatMask":"","FormatStyle":0,"GroupSeparator":" ","NumberNegativePattern":0,"PercentNegativePattern":0,"PercentPositivePattern":0,"UseCultureSettings":true,"UseGroupSeparator":true},"Formula":"","ItemMargins":{},"OddLabelsDistance":0,"Position":1,"ShowSuperposableLabels":true,"TextAlignment":1,"TextAngle":90,"TextRotationMode":1,"Labels":[{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"360\/0","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":0}}]},{"__type":"CustomLabels:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":null,"JSBindingsText":"this.setDistance((this.getInstrument().getByName('Joint2') .getRadius()+43.75));\u000a","Name":"CustomLabels4","RecalculateAll":false,"Smooth":true,"Stroke":null,"Style":"CustomLabels2","ToolTipValue":null,"Visible":true,"Colorizer":{"__type":"SingleColorColorizer:#PerpetuumSoft.Instrumentation.Model.Drawing","Color":{"knownColor":164,"name":null,"state":1,"value":0}},"Distance":440.625,"Dock":0,"MaxLimitWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"MinLimitWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"OriginWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":0,"Value":0},"Padding":0,"Font":{"Bold":1,"FamilyName":"Arial","Italic":2,"Size":6.75,"Strikeout":2,"Underline":2},"Format":{"CurrencyNegativePattern":0,"CurrencyPositivePattern":0,"CurrencySymbol":"$","DateSeparator":".","DecimalPlaces":2,"DecimalSeparator":".","FormatMask":"","FormatStyle":0,"GroupSeparator":" ","NumberNegativePattern":0,"PercentNegativePattern":0,"PercentPositivePattern":0,"UseCultureSettings":true,"UseGroupSeparator":true},"Formula":"","ItemMargins":{},"OddLabelsDistance":0,"Position":1,"ShowSuperposableLabels":true,"TextAlignment":1,"TextAngle":90,"TextRotationMode":1,"Labels":[{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"10","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":10}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"20","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":20}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"30","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":30}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"40","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":40}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"50","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":50}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"60","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":60}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"70","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":70}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"80","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":80}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"100","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":100}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"110","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":110}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"120","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":120}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"130","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":130}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"140","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":140}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"150","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":150}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"160","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":160}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"170","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":170}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"190","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":190}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"200","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":200}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"210","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":210}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"220","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":220}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"230","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":230}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"240","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":240}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"250","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":250}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"260","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":260}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"280","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":280}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"290","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":290}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"300","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":300}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"310","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":310}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"320","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":320}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"330","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":330}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"340","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":340}},{"__type":"TextItem:#PerpetuumSoft.Instrumentation.Model","Text":"350","ValueWrapper":{"__type":"SmartValueWrapper:#PerpetuumSoft.Instrumentation.Model","Kind":1,"Value":350}}]}],"Colorizer":null,"Maximum":360,"Minimum":0,"Reverse":false}],"Margins":{},"Center":{"Height":862.5,"Length":1072.5262234556319,"Rotation":0.93428811100694553,"Width":637.5,"X":637.5,"Y":862.5},"Dock":0,"Radius":396.875,"StartAngle":90,"TotalAngle":360},{"__type":"Picture:#PerpetuumSoft.Instrumentation.Model","Active":true,"BreakEventsBubbling":false,"CssClass":{},"Fill":null,"JSBindingsText":"this.setCenter((this.getInstrument().getByName('Circle1') .getCenter().minus(new PerfectWidgets.Framework.DataObjects.Vector(0,(this.getInstrument().getByName('Circle1') .getRadius()+109.375)))));\u000a","Name":"Picture1","RecalculateAll":false,"Smooth":true,"Stroke":{"__type":"SimpleStroke:#PerpetuumSoft.Framework.Drawing","Width":1,"Color":{"knownColor":35,"name":null,"state":1,"value":0},"DashLenght":5,"DotLenght":1,"SpaceLenght":2,"Style":1},"Style":"Default","ToolTipValue":null,"Visible":true,"Center":{"Height":134.375,"Length":651.50816619977991,"Rotation":0.20774326200329996,"Width":637.5,"X":637.5,"Y":134.375},"Size":{"Height":228.125,"Length":498.95398397547643,"Rotation":0.474851621957083,"Width":443.75,"X":443.75,"Y":228.125},"Angle":0,"Base64String":"data:image\/png;base64,iVBORw0KGgoAAAANSUhEUgAAAI4AAABJCAYAAADrEB4EAAAABGdBTUEAALGPC\/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAjOUlEQVR4Xu3dDdifY\/kH8Mdaa16S5l3krbysNSVJJEliSUuapQihEJI0hRbNS7NmFSuxJG8VqtnWsFgMFTPUqn8r\/8gk81es5dix9Bz3\/\/zcu8+na789D8nYb3qu4ziP3+\/5vdz3dZ3X9\/qe3\/O87vv3dLyQ2q9\/\/et+d91118YzZ87c6Y477hj+85\/\/\/LiwcWFX3HbbbdPCZoXNufXWWx8O6wyrZsyY0a3dfPPN1U033VT95Cc\/WcqmT59e3XDDDawz7OEbb7xxTjzOjMdpP\/7xj68IGxfPjwsbNm3atJ3iceMrr7yyX9PN3ra82u23375p2B5hRwcoxv\/sZz+7IeyBAEUFDLfcckttJQBMdlpMZE58FRNb2\/XXX7+EXXfddU9pU6dOre3aa6\/tMq+Xf7e+Hp+\/\/0c\/+tG0sPHx\/Og4z+7xfONmWL1tWbYAxxbBIPsHg4wJkEwPgDz+05\/+tAZIGpAASAmKWPVdgCgmrraYrGrKlCm1TZo0qbZrrrlmCZs4ceIztvJ75bHK43s+efLk2py\/ef542PT4e0y8v\/8PfvCDLZrh97Z\/p0UY6HvPPfdsH0AZEUC5LoDyeAClSqCU7JFskQwBGABhIkowmMSYiOr73\/9+dfXVV9d21VVXVRE6avve975X23e\/+90l7Dvf+U5tV1xxRdfzniy\/k8fxmMdnzpfm\/PrC9Cvthz\/8YW3F88fDrgsbEbY93zRu6m0aRgkbESCZGrYASDLMAEkyCJAkOJIpgIKTOTsBkZNnQk365ZdfXl122WXVpZdeWl1yySW1ffvb364uvvji2i666KIu++Y3v9llEyZM6LLy9e4sv\/+tb32rNsd1jjyfc6fpiz6xVvAliLsDXTxfEDY13j8hPvvfx0hVVfXBKnfeeedZAZg5GIU2ARTCE1CAJHUEBsEcAGKVJjg4OyfAhJgok2YiTfYFF1xQff3rX6++9rWvVePHj6\/OPffc6itf+UptX\/7yl6tx48bVNnbs2OpLX\/rSUjZmzJgu6+593zvnnHPqYzge++pXv1qf57zzzqvNufXh\/PPPr77xjW\/UfSqBmEBLsCXIgKsEGCuZz\/Ow\/4nnZ8R72zeufWG2WbNmDY4QNC7soWCWrtAj7CRQsEkyCZBYcckenMexyRIJDhNicoADKHKyzzrrrOq0006rTj311GrkyJHVZz\/72erEE0+sPv3pT9d2wgknVJ\/61Keq4447rjr22GOrY445pjr66KO7Ne+l+azv+H4ea8SIEdVnPvOZ6qSTTqrP5ZzOfcYZZ1SjR4+uzj777BpoCS6g0l\/AKsFlPBdeeGEXuJLJWhmsNECLx4fi\/bHxOKhx94rd7r777jUCKEeHXpmFWVrBIvRglGQTQAESq41TkkE4k3MBwwSYjNNPP72enBIUJvOTn\/xkFxiOOuqo6sgjj6yOOOKI6qMf\/Wh12GGHVYceemj1kY98pDrkkEOqgw8+uDrooIOqD3\/4w9WBBx5YHXDAAUuZ19N8zud9zzGY4x1++OH18Z3H+T7+8Y\/XIPvEJz5R9+f444+v+6aP+vq5z32uBtcXvvCFLnBhMeyVjNUdW5WgSmAlYyXIwmbFZ46K19ZopmHFaXfdddfACEUTIhQtolkSLERsClhgEXZKNuEMDuI0K1Mo4NAvfvGLNUhOPvnkeoWbDExgkkyaicyJ\/+AHP1jtv\/\/+1Qc+8IFqv\/32q+39739\/te+++1bve9\/7anvve99bDR06dCl7z3ves5S1fsZ399lnn65jOe6wYcO6zuW8zq8fCTyAS7AB78c+9rEaXMANVMaErT7\/+c\/XC+LMM8\/sAhMftDIVQJUs1YMtDJsQnxnYTEv7tghHOwfDTArAdBK4NIu0mFYRgojYklVQsBVkRQELB3EYkFiZnGrlcjSHc7xJMCEmZ\/jw4fVkmbwEw9577129+93vrt71rndVQ4YMqfbYY49q9913r+0d73hH9fa3v73addddq7e97W3VLrvssoS99a1vrW3nnXeuH1vf9x3fdQzHYo7rHHvuuWd9PufWhwQdkOkf8CawPvShD9WAwl6YD2slY2FJgMJQJZj4JXVVqanKsJdgYgmusM6wifH+zs00tU8LwOwQ4WgGdiFyCVyaJZklwYJV0CnKNVhOoEXQNicBCqdxIGdyLIBY0ckUJmWvvfaqJ+md73xnPXkm02TvtNNO1Zvf\/OZq++23r7bbbrtq2223rbbZZptq8ODB1aBBg2obOHBgtfXWW1dbbbVVbVtuuWWXbbHFFkuY1\/JzzPfYa17zmvpYjuv4r3vd6+pzveENb6je9KY31X14y1veUoMP2HbbbbcaYPoM0MZQgsr4ACpZyrgtFH7ArEIePUZHCXMWFlZK7VSK9BTo3VmE+pvis8tfTAezqOBekeFI2ky3yIJoFmAh3oAFfVodBmj1iO9YhVMwCirP8JIMYvVyNqdb5Va9CUlwmCiT9trXvraeUJP9qle9qtp0002rjTfeuHrFK15RbbDBBtV6661XrbvuutU666xTrb322tVaa61Vrbnmmj3agAEDup77rO\/k9zw6jmOuv\/769fGdZ6ONNqrPudlmm1WvfvWruwAGXK9\/\/etrICeogNxYElDYymLAUgmmkp0y1AnLGImGo5foOyDCSBZghrcSTGXW53m83hnvXxafe\/4r1hGC+gdgRgdgFqq1ELrCUbILzSIMYZbUK1YH2rVyDF7YQdcYBY1bgZzHiVjESgUSAOF44MAAm2++eT1BG264YRcoegIEALz85S9\/KB5nrrHGGhPDLom\/x8TjyLDjwg6Mv\/d62ctetjuLv3eJvwd3Z97Lz8Xfe\/luHPf4eBwZf48JuyTOOTFsZvTj4QQYAzD9LYGF+YAeoHbYYYd6rMlOmDSZyQJKIPEVRgIijGzBYSRMTf9h7tRICSR+L0sL\/mbx3sLQjmfFd56fPbTIjLa77bbbZmMY+oXYBRi1FboFu4ixqFFHMYvVQauI41YPbcIhCRTOQuscyJFWKcdiEOxhNVvVQGJCgCImqopJq2Ii\/7b66qvPDLssbGT8PTwed4j3rKjlWW3tqw8vfelLdwqADQ8bGYC6Ivo\/K9jvb8BkXJtssknNkhhK+AOmN77xjdWOO+5YsxKmpaESSBgp9ZLQxp\/CmkSh1EbYiO8BSeaWYErzN4v3Zwd4tm36vOybkncwzMjQME8KSckwACMcyYgARsoM0TotW7AqMIs4nmDhiNQl6Js+4DQr0arkVOyBMQIIVQChtnj+YDxODDslbMjKK6\/8iqZ7K1zTd2MwllgEE4OZHkxmwqqAlIwkvFlYQNQdG1mICSJMjtFlnjRRWVcaNWpUF5A8Mq\/F+4vCRoYt24UWDLNOAOY2opeGUaATkkqGScAQb9jFADIMGSSwGHiGH6wi9FhxQg5Kz\/DSMElnOPXuWLFjw\/ZeddVV122684Jt4YN1A0R7x6IZG8\/vDpbt5B8Lil4SsrGyBWfh0UcJIsmDxcnnFqpsDcMLZclC5oZcYMDEPPf6Kaec4jO3xGfXabrz7Fqk1duEjplLx9gjInqVvBWdpNFCkljq5EQb2tR5q4GwpVcMFP3KQGQnwo+VRbAmqwQ4qtVWW+2BsHPj+dB47eVNF\/5rGx+Ej4ZGiD43FteD\/Gax0XsSAyDCREK9kC+ZKFmIsKaHsL7FnJkZPQQoaf4GLO+NGDFibkiL1zRd+M9ahKe3hI5ZkCwjLEmpiV4ZEvWO7iCaWBN3od8grAjpMcAIQ0QhKgYUIAkGSftFgGXUKqus8tzF2RdICwbePjTSqFh0s\/lTOMNCwr3FmaGMHJBsYKFSC8nKUgflNonM1iMd6rVmG2Z+fG7H5rTPrF1\/\/fU7BmD+rnCnwkvHKNZl\/UWcdDKAkTbqqHAkMxCTDQi7vPKVr6xFrTBUMMvDAZix8fjC2FtZDi3AMzgW4rgA0CMAJPRbpBarOci6UYaxBFCm9UKYCCEjAxbmudewU4jtv8fnnhl4Qvi+PsLSAvWYZBl1mMyUxEbiS6FKp3QQw8gEEjBiM8DIfmKlAEtngGVqMMvQOEXvtSXLrvWNhGKfyMyuCx3UmQxES7YykBBmkUvpLfjMxIAl9\/jU1YCq2d+bH+D598LW5MmT1wrAzHV9iwIeLaN0rYCUWsaBxVDCTHxNDUPAyYqwC2YJkLCFYRNe8pKX9F7V9hy3YPeBW2yxxYSYhydlqpmNpQbCPtL5rFQT0QR0bsoyzwGKLiKw4zP3xecHNKfouUVYutalDBmaUssITWKjg0EullFngG5iTcwldjFMsAvAPBkp5\/h4XL85dG97nlpoyo3CJkQy8qR0XiTI8GWxJ\/ukgJYBAxDANExTJzkiivcDZNc2h+6+XX755YfKmFz7kQJYaFIDIJwciGrXAVRI2QtLCllYhtgNsLCJwTCbN4ftbcupBftsFQC6DvtkBibLtehtb2QKn9oHWJgw1rBNnSH7THz20OawS7ZglwEBmMda6zIKeYQT0DiZuEmAiaUqu1iGhgGY\/v37P9CvXz8apre1UYvQtW\/M1\/9lDagMXYhArU3oyj0x5jlAYSXsFJ\/7S9jS1\/iE+D0nL2\/IjUhMo\/qLyoDGCdGeiqbqZoKGlgnQXBmHWX3x0Xpbu7UAz4CIEFNaaz+pexI8hDMTooDG68DVXKpyVnO4xS1S7NUCMAty99qFU7l7TSRBHIpLplHJVOkVmgIwnRGWTmgO1dvau\/WJJOa01DyZcZVhC3gwTYYoc08T0Ubx+fnxvdWaY3V0BFiOFJpsydsAwzQqidIziHMCFEfTqFwm0wRoFkVo2rc5TG9bQVokNIfEfHaSHWpv2CQLhsCCadR9\/J1sg52wVCREhzeH6egIAXyj0CRzsneBaYBGiPIl6JQ9qQAr6DWg6QzQDG8O0dtWsBbAOTwzrWSdcufdo7+9Tkz7nM8HW11fH+DUU09d5fTTT18kNNlJxTTEsJQM+nxBiKLMbf9jmwhNVYBmTH2AFbhdc801606cOHHglClTdp40adLQsAPTJk+efCwrXwsbetVVV+185ZVXDozsc4XfdA0gTDC\/WWFO4JQhKq9mwE6iThDIovhef8DZTlHPRpc9C6BRCJKK+ZKKMLaxQam4Z68pQPO\/cd7+i0\/f3m3q1Klrx4QPCZCMCLsgnt8Udn9YZ1h9LXRP5rIRhVB1rbygPi99VRQNTdgZIf7+sWPH3hSMfcGZZ545Ilh7SDyu3Zy+rVsAZvWQIXNbd9gTOF4TouhbNTvaiFwJ27bjxBNP\/LAajeJeeXG4OEfbUOB5GQTgKPBFmPpXnGuz5rqhYJA9YuLHB1DmtIKhJ4vP1hfT550XeTF9eeeFLRcVdFowQzumFt5z4fGj8v2xxx4756ijjhp\/xBFH7BGLs223WGKOjyFHgEaIIo6Z54gDBpBHXg6DQMIO6Agto3WVm4GGtnGgpCfbCYBjW98VeME6bZd2R1hZJQBwUtjDJSB6svKmP0XPSy+9tN5eybsubOa65FWWqQgq03QlgMQhQ7pNXgyd\/lN5FeL5T91LWmsSYgU\/FP48KVbwKk1326apzWAX\/ZSCizRNtbhrSwl52L4gV2wrbb311sd1xGDPLkvNqoZZIU7gyP1z8zLA86fmnG3TIhxtGMC5tzuApGXYsWnbGnYUPJUiZJa2VxQ+ZZfN1XH1\/pyEATNj5XIj0E6zKquCWWvtA9U3aWw9AaEN7g3bsOl227QA+jzjUDUGegVAKTntk2xDrqjfwUBk1qd3BFBGAosvpAN8KavEgANtWAdNBeKeaM7XNi2AcUkrUDLs0CfCjm2UDDv0SWvYcf1thh0XNwk7efOfHeRkY87lWCuTn1B6CkmUnxkI31mpEgsLz54RfRCr9pKm223TYoxP5GJAHnBgEQB8zr++y6oVfoM8Tu4IOj3ahxhHNNTaJYx9kSjKwaOrWhy1UYuwc3J5C7Gw03qzX2vYoU9aww59kmHHdbslAws7xb5NvbD4KMVj6SursxGRS1n48OSm223RglG3tVCM3yLBokgEDoAfaMx7XuqrHLPBBhsc3RHU+m6rhnEKmuUYTmnotXaIleMgABSOuag5b1u0GHyfCDujI+w8KezQJ8KOC84y7NAnrWGHPsmVJlyja07LsMN5Wc\/IsCM1Tb+gcD7Je7yexlzqMDq622dxr9ujhX\/OF5KzDGPBWChYVCaVtyfRNtimudNkz44AyGacIiZbRSwp10riIJQLPBwFQLGqOuP5m5pzt00LNtk0ws64cEInZ7SGHfqkNezkLjC2pU8snny0gPgm09EMO8J2N8Do1mKldsbj2JiATZtutk2LcL1daLpOiwpw+McCsmgwKfYUYVw2Y0PbdeKy6rBX1geImPwnK4n5AhPfkoIBJw2AGvt9gGqt+gBt1lZaaaV5MkC6A4sASoYd+iTDDgdhHCATzoQ4IY82kmkR0HQRTSS0WZFWI+bpKRxZne4Jc363+Lz4xS+e13SrrZr9yUgI5mDlZBxhmr8sGnOd2TRBrBQjo1555ZXnNofo6IjVdKEVhV3EtTSg8RrL98vn8Zk74vFfm17t0+bZsTdorIFtiGGTj32IYCKZiHaPe\/4cHHO\/WGRoXXel5i1AeRUkfSTk0QRAJGxZkU3GWd\/qw8Fu8bEJ3I7AiXH1i\/H\/hO4zHjqPj4QpYZpMyZqNcblIT4iy1RTj+XpzmI6OiNM7itWoCR0XrFIjL4ECSAkqDsNIwUy3BVM9\/aWFz29bCjhEMrEMDG7zARL3ibkj1Q8llD8f54ZDgAIs7AM8mAcrWaEysHR2VtmF8RUBODGW1cMPNys\/yCgtIotJCBe6SRY4ABoXwdM17qJtCr\/Gs+SPFgQtzYYyFCyOM2BKICVwEjBSTqGNFgrqvje00eDmUO3QlgCO7EntRhgCGrcuA4yfkLv99turmTNnVnfeeWf9mL8Wlr\/nk+ARxtR88oJ9x8zNYHopa19WaLsCJ0Lv1gGa31oAQCNE5RiEKKEbUWS4tTfp6k4hlz\/79u07qznUv1p8+D2+0KTbdQomxgETEAEQ5sE2CRpaSLxHbSEiF4amOFaG0xxyebYaOMZCIJt0ky8EAQ1mAZhZs2ZVv\/zlL6tf\/epX1W9+85v68Re\/+EUNIqDCPphH2Cov3M\/bg2RoUngUT2TLwugq\/rOn1y7AMScB+iODdZ\/IKzuFW0xD4wGNhAAp8BnQuOYKaPK6q379+lUvetGLhjSHXLLFCr0JRakQliBKAKFjzINxSuDIwmRj0tZY4TdFKre82Weem\/\/QsBBD6Jp8IAAGrHL33XfXYPn9739f\/eEPf6juu++++nHOnDnV7Nmza\/BgHmELS6k6AyBtlNoAKKX1whXhLTPjA37B3FhneQMnWGZQ9Hk6wOdFetnvBA3AIwNzLe3GNMQw0NA1DWimN4dcuoXI22zQoEFPqBASfKgekBJEAIR5SvAIVQ3j1FQtNARwntxvv\/3GR+xfNvchP8MWA36UBuEshUC6JtkGGIACu9x7773V3Llzqz\/\/+c\/Vww8\/XD300EPVH\/\/4x+p3v\/tdzUR33HFHHdKSdQAQEOmDDFe5amVtqN74+YSP+G211VZ7tOnW89pi7OtEWBp\/\/vnnPwno+msh2YyVdss0gR1ozKW+CrM0Td5EmaDp06eP3YLNFh+5h7blllseqkJIGKEsCAQkIEomspronkYc1ysMeLBOgkfhLMCzIDp2RqS+z9u1K0HB60XG80+rSzFQSi1M+TkWugXb3HPPPTWzPPDAA9W8efOqxx9\/vJo\/f37117\/+tQYR9sFGAEY0u2\/e7rlwJcNSYGzVCHSONF\/hDAvTg0J8LMB\/hg\/Xa7r3nLcIR+uHhjkjwL1AWAIYdRphFcsQwUBOkwmriMDcmnPiXq2GRnNfnOuugmmqOOxBi4\/+NC1QdwG6EuccEBITRJgIC9FATspBaK5kHh1C2ZwodgZwFoZdECvyOf0hwwBNv3DQnSrFUmdhRXgRZqTZwhRtg02EqAcffLAGy8KFC6t\/\/OMf1YIFC6pHHnmkZp3f\/va3dTijdYQrItkGKZ1DXOZ98yVwpLIWTAkcCy0W3p3hu+f0B4yCYQaFXRCAWWjR0DH6h3kBRh8V93I7IVPuMjTJCAlhoGnCE7Y5rznF0zeDDPRNgUDU5cAqh61MBKmcQzRn6Co1D\/ZpmKfurKJb6IDpsTIPGTZs2DKv\/4RQHWNldQccjLMcgWMR2m5Ypq25yeCQyPRuFY6wYF4zrmKuXJCAEZaSEc0VAjCn5pgIzt8kagR9tdJKK7FJcZpndi0R8MQBp4p37gMvQVQyEQAJYQkgyrwEULJPAqhhIHpgQQzkorDdQw886wudwjmDAzidgKPO0hqqCFx1G7+3nKEKQISqxx577FmHKvTfXagCHD6KSeoM\/z3rH1nAqnHu3cMujuzuCcySO\/vGTnPlVZw2LBMw5IO5IYCzPoNl1GiIYHUamSjQBMsAzZQ43X\/GksATB77awaGyBJFqYgkiztGpHXdc\/BNkJYAyfBXap2QgA5sfq\/WKgw8+eFgA6j+6SCyAM53os9KkylLmFMeYAmN0J47pnFIc33\/\/\/TWopOXYKcWxyzTUgnoSx1kHKcWxUGBRNcDhu54zk6dowSarB8MNC7B8N4AyPzdtnT\/BoiygH0oD+mJrhX+xvnkwLwCTYcmcEsBYhgh2Q2Xfvn1r0IS5R+5Zh9Y+gcjRToLOShDpQGs40zkZWHfZV5m2W5kliACI4wNAi0K4zQgbFfF41whpTzuA+M5gocLKxwCYACOY4EzHTXx36bgMShrOAEmIerp0PLceniodt3hkoYCTxTT+8vMkTbd7bMEq\/UePHr1bnGNUgGRGLIRFxqT2Aijl9eHAkntx9At2weoArB+KuBa2hW7OSsD42ZmSZeLUbNnu4IfSHh42H605MSHVCiJslEykszRQ1n9SRJcgKkW0jbUSRBxAMwSAFsbquSHsrJicYWFL\/cxqAO6bVpmMwR6SCTWx4r6JznAlJRd2sAjwlAVABjDCmAoybSMLay0A0jdZAMRu3RUAjdOYMTAf5Ernp1h8Fzbd7mrBHhsHewwPYIyJ59Pj+SJjABLnsBiMC1AsjrxeyJhzdx9Y+JFvVX8tXgu5O8CoL\/lhCFkTlqFnohuPhe1Td2hZt0Do5muuuebtfmBAyuZWmZKJpHJlSNNpoYwQk4VBf08g6iaVrycCC3FMA6KagsNZj4ZNCxCNjVV2RFDyXzmQM01khisClh7BOuWWA\/BgnnLLganbABRdk6AR4tSBsE1uObhiMMNUCmN902djEaaFBpNn7LlRyC\/ho78EYxwRoBgXNi3sUf3FInaoEySErQurMErr9ULOZWE5n4XnnJidbzEckPK\/+TA35glg6BgZk7DUwjLTwjYwx89l6zNgwIDjw55QVtchLJQgSiZqBZGQZgWULCSUcfK\/AyIrKpkIkDgvV5v3\/W0COdqEonWsI6wQydhCyAIezGMfShgCIFsQDBMBDC0kfSeIMVVucgIhMOZ2Q25yClOlvmnNqHLl8wk\/HXbYYfV3GaADCABiTCCxAAhbnyuBQrPkdUKYzbn4ELNZoPzM5\/wPMOalJ8A0LKOw97F6Vp+vFnS3cYiqy+KxU8eAKJkogaTzJZCAKHURZ3KqVZkFRQ4vgVSm9mVYA6bMzvzNkUBlAsX7ZB0CkojFEkJWggcYhB\/sAyCYBZA85j8pyf87Ue6MZ8keKJNtTDAW1J8MU8aCYdW7ct\/HpPIF36ihYBDfBXZMAiSOg1mBxHgc01iNW4LBJ4AClJiFHHDcMhQlWMwHDSMkAUxRlwGYzrDLwpbf\/wMN8GwfaJ5Bmeuo+JkgMoASSBnWSn0ESAkiKwcb5a58bqq2VqhLVgIuz1tZh2hV\/MIOhDLwYB7ptLBDswAQBgISQPJIBAMMgNFGLsUAGswlRBGpQgpwZtke2wCwvuhvhinsWpbxjZ1PjBFT+l4CBJM4BpAYj3Eas4XED3yCwYAlgZJhiI8TLPxvLhIwLQzDZoRtZ+7aooU6H7rqqqvO1GG0mCAq2agnICWYMrxxNEFpVeX+mFXMgVipBBPHomwOx0DCl9WMDbACkZngIZaBgFYBIMDAKPRPGlCVN+LJzDBNggaTCTFl6T7ZBiPoZ2ZTmYZj2AxTfGFsPo9FLAKA811sZTzJWPQRveK7JVD4jx\/5tDuwYJdMrQvA3B62t7lqy9a\/f\/9dovNTAkh+LLIeDCAlIwFSd2DqiZk4jePRPdrnTCuPY4U4oAIiE4DWrWIsQCfQDsCDeYQtky8jwj4AhIGACKukAYv6Dz2DZQCurMbmrnKGKGAFWuBtZZuybmIsxmjsxgMcWATIjMe4sElqIZ\/nh5JR+Mv3AYUv+ZWPgaW5n78VMEKS6m\/7\/cuhnloMYmAMZnzYfFeOqRd0ByROKJkpAZWg6o6lrD6x3aRwurhvxVrFQhaNUIJHlmLSTb4qKwARuZgECwFSGrB4HWDoGYDDWsITpknQYDZhRngRVjKrAeiSbQABi+q3MRm3RZG6J7VJAiTHzg8JkgRKskqCpbkir9YugFKwi9T63LD2\/ydnT9H6B4j2D7suzI8w1QM28O7A1B2gngpUVq9VLoRZ9XSP0EFkAo+wZbJNulRXNgRAAAFEwAFIzHPs4nVhCWAADvBUpWVQNFSCBsPRI0KMMEq7lCl4yTaAbxzGanwlQEqQJEAYn7QCJVklhW4BGOwyNWx\/Pg97QbWNYrAnxMBnxErx+zo1xbYCqQRTK6BKUDGr1SoXsoSKEjyYRzprsk069gEg4QuDABFwyJKY58Ka170PMEQw4GEvmkZ4SqYBmsx0hJ0MUUJqqW2SbfTdOI2pFSAlSPghgVKGoB7AQuyeELbC\/kOUZ9r8FMjh4YxJYYs4Bu2WYCoB1QqqNI5PES1UJHiELYxgkglY7CPEyIQAAYMABc3CgMRjWVshgAEG8AAQiylKSv9pqhI0MkLptxCVWiUzqdQ2+mtsOY4cVytI+KHUKg1I0haG0S1+MWSF+DmV57L1D0ftFo4aFSCaEY+LrC6WgCpBlZbgkoXROpmBAY\/UHSOYZOxDNGMLAMIcQhhQABI2SvO314EsK7UAA4D0EzajaYSnEjTAq6SQ6bcQRb\/QLkIRRgGQHEeOKZmEAUoJlgYwi8Kwyqiw3fgqrLf10Dhn93DiKeG8SfH4IIeWYErjfKu5zLZoHpNqcqW62EdoASAAAAQgolUAA5jS\/O31sloLMFlfwWaZMivEtYKmLPeXIQrDAEyOwyNrAQl7MAyjnMIHYb1AeZZNDFeHOC3s6rDZ4eyFHG4Cck\/MJJpMTGBysY+QkgACgKw8CzuAAUxp\/vY6sAAbhhGWAEbmRIRjtRTCwlN3oBGiiHc6LEMUwES\/04Sc2WHGAiR7hb3g\/ydXuzTb\/+7JHhKTdJnJM4km06QKXdgnK9AYCACEGuwBSIABTGn+9noW5oS8BAwNlSyD3VII0zStoEldkyEKO0Y\/Lw3bo+lzW\/34wH9z6xOT93PgMZkmNdkHgDBQbqwCETAAEjZiAJLPvS4cAQvQYRiAEQZLlsnsiaZ5KtAIp8GMt+rj4q72trZqMXmbxCTON5mqtiY3AWTCgajcCwMk4azVvIepgAXofC8BIxwCDIAKj7InQjg1TQ+gmR\/dW\/wLD72tPVtM4hD1E6EjASRFNuEmvgQRwyKl5es+Ixz5PPAlwwBMyTKqwgp8sieaphU09Fd0S3jqbe3eIoOZjwWwQQIoQxgQAQEgAQQwleY15v0EC\/DRMRgGYABTjSZDk6qw7IkQbmEaghjb9LYVpM0ziXnZhok24QkiIAAkgGDAkeZv7yWzAIvvASGGScAky2RoypRbXSlBI5OK5233Mye9redW\/+gAEKRoNeFA5G8gYAmmVvO69wEuwQKErdfAlCzjfICSBT2vAVIvcFas1vUzJ9JuQteEYwmTD0iAABBpQFX+7X2fS7AQvnkdjEpwAqZkGYBx3qzf9AKnvZqb9161+Gm3baWwWpSaUCHEZOcOdXl5BkD0ZN73uQQLdsmQlIChZVSDsxIMPCxZJyvD0Z9V6569YFpHx\/8D8qncJnKKmcQAAAAASUVORK5CYII="}],"Enabled":true,"Focused":false,"GridStep":25,"IsFixed":false,"MeasureUnit":{},"Parameters":[],"ShowGrid":true,"Size":{"Height":1500,"Length":1968.660712261003,"Rotation":0.866302262552679,"Width":1275,"X":1275,"Y":1500},"SnapToGrid":true,"Styles":[{"__type":"Style:#PerpetuumSoft.Instrumentation.Styles","Fill":null,"Font":{"Bold":0,"FamilyName":"Microsoft Sans Serif","Italic":0,"Size":10,"Strikeout":0,"Underline":0},"Image":null,"Name":"Default","Stroke":{"__type":"SimpleStroke:#PerpetuumSoft.Framework.Drawing","Width":1,"Color":{"knownColor":35,"name":null,"state":1,"value":0},"DashLenght":5,"DotLenght":1,"SpaceLenght":2,"Style":1}},{"__type":"Style:#PerpetuumSoft.Instrumentation.Styles","Fill":{"__type":"LinearGradientFill:#PerpetuumSoft.Framework.Drawing","Angle":90,"Colors":[{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":35,"name":null,"state":1,"value":0},"Portion":0},{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4289901234},"Portion":1}],"EndColor":{"knownColor":0,"name":null,"state":2,"value":4289901234},"StartColor":{"knownColor":35,"name":null,"state":1,"value":0}},"Font":null,"Image":null,"Name":"Circle1","Stroke":{"__type":"SimpleStroke:#PerpetuumSoft.Framework.Drawing","Width":5,"Color":{"knownColor":35,"name":null,"state":1,"value":0},"DashLenght":5,"DotLenght":1,"SpaceLenght":2,"Style":1}},{"__type":"Style:#PerpetuumSoft.Instrumentation.Styles","Fill":{"__type":"MultiGradientFill:#PerpetuumSoft.Framework.Drawing","Angle":90,"Colors":[{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4281808695},"Portion":0},{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4293256677},"Portion":0.22},{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":35,"name":null,"state":1,"value":0},"Portion":0.5},{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":35,"name":null,"state":1,"value":0},"Portion":0.78},{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4279589271},"Portion":1}]},"Font":null,"Image":null,"Name":"Circle2","Stroke":null},{"__type":"Style:#PerpetuumSoft.Instrumentation.Styles","Fill":{"__type":"SphericalFill:#PerpetuumSoft.Framework.Drawing","Angle":216,"Colors":[{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4292865771},"Portion":0},{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4278224383},"Portion":1}],"Delta":0.3,"EndColor":{"knownColor":0,"name":null,"state":2,"value":4292865771},"StartColor":{"knownColor":0,"name":null,"state":2,"value":4278224383}},"Font":null,"Image":null,"Name":"Circle3","Stroke":null},{"__type":"Style:#PerpetuumSoft.Instrumentation.Styles","Fill":{"__type":"SolidFill:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":2600502783}},"Font":null,"Image":null,"Name":"Star1","Stroke":null},{"__type":"Style:#PerpetuumSoft.Instrumentation.Styles","Fill":{"__type":"SolidFill:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":164,"name":null,"state":1,"value":0}},"Font":null,"Image":null,"Name":"RangedLevel1","Stroke":null},{"__type":"Style:#PerpetuumSoft.Instrumentation.Styles","Fill":{"__type":"SolidFill:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4278337922}},"Font":null,"Image":null,"Name":"ScaleMarks1","Stroke":null},{"__type":"Style:#PerpetuumSoft.Instrumentation.Styles","Fill":null,"Font":{"Bold":1,"FamilyName":"Arial","Italic":2,"Size":12,"Strikeout":2,"Underline":2},"Image":null,"Name":"ScaleLabels1","Stroke":null},{"__type":"Style:#PerpetuumSoft.Instrumentation.Styles","Fill":null,"Font":{"Bold":1,"FamilyName":"Arial","Italic":2,"Size":6.75,"Strikeout":2,"Underline":2},"Image":null,"Name":"CustomLabels2","Stroke":null},{"__type":"Style:#PerpetuumSoft.Instrumentation.Styles","Fill":null,"Font":{"Bold":1,"FamilyName":"Times New Roman","Italic":2,"Size":20.25,"Strikeout":2,"Underline":2},"Image":null,"Name":"CustomLabels5","Stroke":null},{"__type":"Style:#PerpetuumSoft.Instrumentation.Styles","Fill":null,"Font":{"Bold":1,"FamilyName":"Times New Roman","Italic":2,"Size":14.25,"Strikeout":2,"Underline":2},"Image":null,"Name":"CustomLabels6","Stroke":null},{"__type":"Style:#PerpetuumSoft.Instrumentation.Styles","Fill":{"__type":"SolidFill:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4291355902}},"Font":null,"Image":null,"Name":"Circle7","Stroke":null},{"__type":"Style:#PerpetuumSoft.Instrumentation.Styles","Fill":{"__type":"SolidFill:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4278809030}},"Font":null,"Image":null,"Name":"Needle1","Stroke":{"__type":"SimpleStroke:#PerpetuumSoft.Framework.Drawing","Width":3,"Color":{"knownColor":0,"name":null,"state":2,"value":4278809030},"DashLenght":5,"DotLenght":1,"SpaceLenght":2,"Style":1}},{"__type":"Style:#PerpetuumSoft.Instrumentation.Styles","Fill":{"__type":"SolidFill:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4294934656}},"Font":null,"Image":null,"Name":"Needle2","Stroke":null},{"__type":"Style:#PerpetuumSoft.Instrumentation.Styles","Fill":{"__type":"SolidFill:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4279800053}},"Font":null,"Image":null,"Name":"TruncatedEllipse1","Stroke":null},{"__type":"Style:#PerpetuumSoft.Instrumentation.Styles","Fill":{"__type":"SolidFill:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4294934656}},"Font":null,"Image":null,"Name":"TruncatedEllipse2","Stroke":null},{"__type":"Style:#PerpetuumSoft.Instrumentation.Styles","Fill":{"__type":"LinearGradientFill:#PerpetuumSoft.Framework.Drawing","Angle":90,"Colors":[{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4294936969},"Portion":0},{"__type":"GradientColor:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":4280455413},"Portion":1}],"EndColor":{"knownColor":0,"name":null,"state":2,"value":4280455413},"StartColor":{"knownColor":0,"name":null,"state":2,"value":4294936969}},"Font":null,"Image":null,"Name":"Circle5","Stroke":null},{"__type":"Style:#PerpetuumSoft.Instrumentation.Styles","Fill":{"__type":"SolidFill:#PerpetuumSoft.Framework.Drawing","Color":{"knownColor":0,"name":null,"state":2,"value":1694498815}},"Font":null,"Image":null,"Name":"Highlight1","Stroke":null}]}
			//creating widget
                var widget = new PerfectWidgets.Widget("root", jsonModel);
                //getting slider object
                slider = widget.getByName("Slider1");
                slider2 = widget.getByName("Slider2");
                //configure animation settings
                if (slider != null) {
                    slider.configureAnimation({ "enabled": true, "ease": "easeOutExpo", "duration": 4 });
                }

                if (slider2 != null) {
                    slider2.configureAnimation({ "enabled": true, "ease": "easeInOutBack", "duration": 2 });
                }
                //save interval id
                
                intervalId = setInterval(animate, 5000);
                //add event handlers
                //value changed handler
                //slider.addValueChangedHandler(updateText);
                //animation value changed
                //slider2.addAnimationValueChangedHandler(updateText2);
            

            
            
            //timer stuff
            function animate(){
                /*
                 * 
                 * Consulta de la dirección del viento
                 */
                $.ajax({
                    url: "<?php echo Yii::app()->baseUrl?>/charts/muestraDirViento",
                    //url: "muestraPunto",                        
                    dataType:"json",
                    type: "post",
                    async:true,
                    //beforeSend:function (){Loading.show();},
                    success: function(dataDV){  
                        direccionViento=dataDV.direccionViento;
                        console.debug("dirViento----"+direccionViento);
                        var degree=Math.random() * 360;
                        slider.setValue(direccionViento);
                    },
                    error:function (err){
                        console.debug(err);
                    }
                });
                var degree=Math.random() * 360;
                
                //slider2.setValue(Math.floor(180 + 1));
            }

            var intervalId;
            //release timer
            function stop() {          
              window.clearInterval(intervalId);          
            }
            /*Fin Brújula*/
            /*
             * conductividad
             */
            var g1 = new JustGage({
                id: "conductividad",
                value: 0,
                min: 0,
                max: 100,
                title: "",
                label: "porciento"
              });
              var timeCond="";
              setInterval(function() {
                    $.ajax({
                        url: "<?php echo Yii::app()->baseUrl?>/charts/muestraConductividadWS",
                        //url: "muestraPunto",                        
                        dataType:"json",
                        type: "post",
                        async:true,
                        //beforeSend:function (){Loading.show();},
                        success: function(dataC){  
                            conductividad=dataC.conductividad;
                            console.debug("conductividad----"+conductividad);
                            g1.refresh(conductividad);
                        },
                        error:function (err){
                            console.debug(err);
                        }
                    });
                //g1.refresh(getRandomInt(50, 100));         
              }, 3000);
            /*Fin Conductividad*/
            /*
             * conductividad
             */
            var g2= new JustGage({
                id: "humedadDiv",
                value: 0,
                min: 0+"%",
                max: 100,
                title: "",
                label: "porciento"
              });
              var timeCond="";
              setInterval(function() {
                    $.ajax({
                        url: "<?php echo Yii::app()->baseUrl?>/charts/muestraHumedadWS",
                        //url: "muestraPunto",                        
                        dataType:"json",
                        type: "post",
                        async:true,
                        //beforeSend:function (){Loading.show();},
                        success: function(dataH){  
                            humedad=dataH.humedad;
                            g2.refresh(humedad);
                        },
                        error:function (err){
                            console.debug(err);
                        }
                    });
                //g1.refresh(getRandomInt(50, 100));         
              }, 3000);
            /*Fin Conductividad*/
            //consulta estado de válvulas
            function blendColors(c0, c1, p) {
                        var f=parseInt(c0.slice(1),16),t=parseInt(c1.slice(1),16),R1=f>>16,G1=f>>8&0x00FF,B1=f&0x0000FF,R2=t>>16,G2=t>>8&0x00FF,B2=t&0x0000FF;
                        return "#"+(0x1000000+(Math.round((R2-R1)*p)+R1)*0x10000+(Math.round((G2-G1)*p)+G1)*0x100+(Math.round((B2-B1)*p)+B1)).toString(16).slice(1);
            }
            var texto ='Temperatura vs tiempo';
            
            $('#temperatura').highcharts({
                chart: {
                    defaultSeriesType: 'spline',
                    animation: Highcharts.svg, // don't animate in old IE
                    marginRight: 10,
                    events: {
                        load: function () {
                            // set up the updating of the chart each second
                            var series = this.series[0];
                            setInterval(function () {                           
                                $.ajax({
                                    url: "<?php echo Yii::app()->baseUrl?>/charts/muestraPuntoWS",
                                    //url: "muestraPunto",                        
                                    dataType:"json",
                                    type: "post",
                                    //beforeSend:function (){Loading.show();},
                                    success: function(dataPointJson){ 
                                            var x = dataPointJson.time, // current time
                                            y = dataPointJson.temp;
                                            series.addPoint([x, y], true, true);
                                            timeTemp=dataPointJson.time;
    //                                    

                                        console.debug(dataPointJson);
                                    },
                                    error:function (err){
                                        console.debug(err);
                                    }
                                });

                            }, 30000);
    //                        setInterval(function () {
    //                            var x = (new Date()).getTime(), // current time
    //                                y = Math.random();
    //                            series.addPoint([x, y], true, true);
    //                        }, 1000);
                        }
                    }
                },
                title: {
                    text: texto
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
                    enabled: true
                },
                series: [{
                    name: 'Temperatura vs Tiempo',
                    data: (function () {
                        // generate an array of random data
                        var data = [],
                            time = (new Date()).getTime(),
                            i=-19;
                        $.ajax({
                            url: "<?php echo Yii::app()->baseUrl?>/charts/muestraArrayTemperaturaWS",    
                            //url: "muestraArrayPuntos",                        
                            dataType:"json",
                            type: "post",
                            async:false,
                            //beforeSend:function (){Loading.show();},
                            success: function(dataJson){
                                timeTemp=dataJson.punto;

                               $.each(dataJson.puntos,function(key,value){ 
                                    var d=new Date(value.time);
                                    data.push({
                                        x: (d).getTime(),
                                        y: value.temp
                                    });
                               });
                            },
                            error:function (err){
                                console.debug(err);
                            }
                        }); 
                               return data;
    //                    for (i = -19; i <= 0; i += 1) {
    //                        var dTime=time + i * 1000;
    //                        console.debug(new Date(dTime));
    //                                data.push({
    //                                    x:dTime,
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
/**
 * Request data from the server, add it to the graph and set a timeout 
 * to request again
 */
function requestData() {
    $.ajax({
        url: "<?php echo Yii::app()->baseUrl?>/charts/muestraPuntoWS",
        dataType:"json",
        type: "post",
        success: function(point) {
            var series = chart.series[0],
                shift = series.data.length > 20; // shift if the series is 
                                                 // longer than 20

            // add the point
            //series.addPoint([x, y], true, true);
            chart.series[0].addPoint([point.time, (new Date(point.temp)).getTime()], true, shift);
            
            // call it again after one second
            setTimeout(requestData, 5000);    
        },
        error:function (err){
            console.debug(err);
        },
        cache: false
    });
}
</script>
<script>
var map = L.map('map').setView([0,0], 15);
L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFva25veCIsImEiOiJmcGJNR09jIn0.d8dHV-Ucm_dxJRbt50d1wA', {
        maxZoom:20,
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
                '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="http://mapbox.com">Mapbox</a>',
        id: 'mapbox.streets'
}).addTo(map);
var puntoUbic=L.marker([0,0]);
puntoUbic.addTo(map).bindPopup("<b>0</b><br />Posición actual.").openPopup();
function onMapClick(e) {
    popup = L.popup();
    popup.setLatLng(e.latlng)
    .setContent("Latitud y longitud en la cual hizo click " + e.latlng.toString())
    .openOn(map);
}
map.on('click', onMapClick);
function creaPunto(){			
    $.ajax({
            url: "<?php echo Yii::app()->baseUrl?>/avl/muestrapunto",
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
       },
    });    	
}
setInterval('creaPunto()',5000);
</script>	