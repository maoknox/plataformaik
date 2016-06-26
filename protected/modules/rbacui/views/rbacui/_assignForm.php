
<div class='container'>
    <div class="signin-row row">
        
        <div class="span4">
            <div class="container-signin">
                <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'assign-item-form',
            'enableAjaxValidation'=>true,
    )); ?>
   
            <?php echo $form->errorSummary($model); ?>

            <div class="input-group">
                    <?php echo $form->labelEx($model,'item'); ?>
                    <?php echo $form->dropDownList($model, 'item', array(), array('multiple'=>true, 'size'=>10, 'style'=>'width:200px;')); ?>
                    <?php echo $form->error($model,'item'); ?>
            </div>

            <div class="row">
                    <?php echo $form->hiddenField($model,'type'); ?>
                    <?php echo $form->hiddenField($model,'action'); ?>
            </div>
    

    <?php $this->endWidget(); ?>
            </div>
        </div>
       
    </div>  
    
 </div>