

<section class="page container cont">
    <?php if(Yii::app()->user->isGuest):?>
        <div class="row">
            <div >
                <div class="box">
                    <div class="box-header">

                        <h5>BIENVENIDO</h5>
                    </div>
                    <div class="box-content">
                        <p>
                        Ingetronik.
                        </p>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    <?php else:?>
    
<div id="freewall" class="free-wall" style="max-width: 100%">
    <div class="brick">                         
        <div class="box" style="text-align: center; ">
            <div class="box-header">
                <i class="icon-bookmark"></i>
                <h5>AVL</h5>
            </div>
            <div class="box-content">
                <div class="btn-group-box">
                    <button class="btn"><i class="icon-dashboard icon-large"></i><br/>Mis vehículos</button>
                    <button class="btn"><i class="icon-map-marker icon-large"></i><br/>Ubicar vehículo</button>
                </div>
            </div>
        </div>                           
    </div>
</div>

    
    <?php endif;?>
 </section>  


