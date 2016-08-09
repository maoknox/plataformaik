<!DOCTYPE html>
<html>
	<head>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
		<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>

		<script type="text/javascript" src="<?php echo Yii::app()->baseUrl?>/js/jquery.thermometer.js"></script>
		<script type="text/javascript">
			$(document).ready( function() {
				// http://stackoverflow.com/questions/5560248/programmatically-lighten-or-darken-a-hex-color-or-rgb-and-blend-colors
				
                                function blendColors(c0, c1, p) {
					var f=parseInt(c0.slice(1),16),t=parseInt(c1.slice(1),16),R1=f>>16,G1=f>>8&0x00FF,B1=f&0x0000FF,R2=t>>16,G2=t>>8&0x00FF,B2=t&0x0000FF;
					return "#"+(0x1000000+(Math.round((R2-R1)*p)+R1)*0x10000+(Math.round((G2-G1)*p)+G1)*0x100+(Math.round((B2-B1)*p)+B1)).toString(16).slice(1);
				}

				$('#fixture').thermometer( {
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
						$('#value').text(value.toFixed(2)+" %");
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
                                            //if(timeHumedad!==dataPointJson.time){
                                                timeHumedad=dataPointJson.time
                                                y = dataPointJson.humedad;
                                                $('#fixture').thermometer( 'setValue', y );
                                            //}

                                        },
                                        error:function (err){
                                            console.debug(err);
                                        }
                                    });
                                         
				}, 3000 );
			} );
		</script>

		<style type="text/css">
			#value { width: 160px; text-align: center; }
		</style>
	</head>

	<body>
                <div><h2>HUMEDAD</h2></div>
		<div><h2 id="value"></h2></div>
		<div id="fixture"></div>
                
                
	</body>