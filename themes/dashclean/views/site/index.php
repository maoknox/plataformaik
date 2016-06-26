<?php Yii::app()->clientScript->registerScriptFile('http://zeptojs.com/zepto.min.js',CClientScript::POS_END);?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery/waterfall.min.js',CClientScript::POS_END);?>  
<?php //Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/nested.css', CClientScript::POS_HEAD);?>
                  <div class="body-nav body-nav-horizontal body-nav-fixed">
                        <div class="container">
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="icon-dashboard icon-large"></i> Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-calendar icon-large"></i> Schedule
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-map-marker icon-large"></i> Map It
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-tasks icon-large"></i> Widgets
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-cogs icon-large"></i> Settings
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-list-alt icon-large"></i> Forms
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-bar-chart icon-large"></i> Charts
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                
    

        <section class="nav nav-page">
           

        <div class="container">
            <div class="row">
                <div class="span7">
                    <header class="page-header">
                        <h3>Dashboard Demo<br/>
                            <small>Additional Bootstrap Components</small>
                        </h3>
                    </header>
                </div>
                <div class="page-nav-options">
                    <div class="span9">
                        <ul class="nav nav-pills">
                            <li>
                                <a href="#"><i class="icon-home icon-large"></i></a>
                            </li>
                        </ul>
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#"><i class="icon-home"></i>Home</a>
                            </li>
                            <li><a href="#">Maps</a></li>
                            <li><a href="#">Admin</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="page container cont">
       
        
            <div  style="text-align: center; ">
                <div class="span4">
                    <div class="box">
                        <div class="box-header">
                            <i class="icon-bookmark"></i>
                            <h5>Módulo 1</h5>
                        </div>
                        <div class="box-content">
                            <div class="btn-group-box">
                                <button class="btn-box"><i class="icon-dashboard icon-large"></i><br/>Acceso a algo pero bieeeeeeeen largo</button>
                                <button class="btn"><i class="icon-user icon-large"></i><br/>Account</button>
                                <button class="btn"><i class="icon-search icon-large"></i><br/>Search</button>
                                <button class="btn"><i class="icon-list-alt icon-large"></i><br/>Reports</button>
                                <button class="btn"><i class="icon-bar-chart icon-large"></i><br/>Charts</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        
    </section>

<div class="some-container">

  <div>hello data 1</div>
  <div>
    hello data 2
    hello data 2
  </div>
  <div>
    hello data 3
    hello data 3
    hello data 3
  </div>

 <div>
    hello data 4
    hello data 4
    hello data 4
    hello data 4
  </div>
  <div>
    hello data 5
    hello data 5
    hello data 5
    hello data 5
    hello data 5
  </div>
</div>

<script>
//  $(document).ready(function(){
//      $('.some-container').waterfall({
//        colMinWidth: 150,
//        autoresize: true
//      });
//  })
</script>
