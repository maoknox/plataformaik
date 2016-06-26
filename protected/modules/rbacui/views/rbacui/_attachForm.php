<?php
/* @var $this DefaultController */
/* @var $model AttachItemForm */
/* @var $form CActiveForm */
?>


<div class='container'>
    <div class="signin-row row">
        
        <div class="span4">
            <div class="container-signin">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'attach-item-form',
	'enableAjaxValidation'=>true,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'attachname'); ?>
		<?php echo $form->dropDownList($model, 'attachname', array()); ?>
		<?php echo $form->error($model,'attachname'); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'name'); ?>
		<?php echo $form->hiddenField($model,'action'); ?>
	</div>
	
<?php $this->endWidget(); ?>
            </div>
        </div>
       
    </div>  
    
 </div><!-- form -->