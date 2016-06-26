<?php
/* @var $this DefaultController */
/* @var $model AuthItemForm */
/* @var $form CActiveForm */
?>

<div class='container'>
    <div class="row">
        
        <div class="span8">
            <div class="container-signin">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'authorization-item-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row span6">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('class'=>'span6', 'size'=>160)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row span6">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('class'=>'span6','size'=>80)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row span6">
		<?php echo $form->labelEx($model,'bizRule'); ?>
		<?php echo $form->textField($model,'bizRule',array('class'=>'span6','size'=>80)); ?>
		<?php echo $form->error($model,'bizRule'); ?>
	</div>
	
	<div class="row span6">
		<?php echo $form->labelEx($model,'data'); ?>
		<?php echo $form->textField($model,'data',array('class'=>'span6','size'=>80)); ?>
		<?php echo $form->error($model,'data'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->hiddenField($model,'oldname'); ?>
		<?php echo $form->hiddenField($model,'type'); ?>
	</div>
	
<?php $this->endWidget(); ?>
            </div>
        </div>
       
    </div>  
    
 </div>