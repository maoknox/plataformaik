<!doctype html>

<html>
  <head>
    <title>Auto-adjust</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style>
     
    </style>


  </head>
  <body>
    <div id="g1"></div>
   
   

    <script src="<?php echo Yii::app()->baseUrl?>/js/charts/raphael-2.1.4.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl?>/js/charts/justgage.js"></script>
    <script>
      var g1;

      window.onload = function(){ var g1 = new JustGage({
          id: "g1",
          value: getRandomInt(0, 100),
          min: 0,
          max: 100,
          title: "CONDUCTIVIDAD",
          label: "porciento"
        });
        setInterval(function() {
          g1.refresh(getRandomInt(50, 100));         
        }, 2500);
       
      };
    </script>
  </body>
</html>