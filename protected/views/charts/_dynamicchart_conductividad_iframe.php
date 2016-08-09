<!doctype html>

<html>
  <head>
    <title>Auto-adjust</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style>
     
    </style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>

  </head>
  <body>
    <div id="g1"></div>
   
   

    <script src="<?php echo Yii::app()->baseUrl?>/js/charts/raphael-2.1.4.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl?>/js/charts/justgage.js"></script>
    <script>
      var g1;

      window.onload = function(){ var g1 = new JustGage({
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
       
      };
    </script>
  </body>
</html>