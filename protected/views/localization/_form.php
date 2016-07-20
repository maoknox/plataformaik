<?php
/* @var $this LocalizationController */
/* @var $model Localization */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'localization-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_entity'); ?>
		<?php echo $form->textField($model,'id_entity'); ?>
		<?php echo $form->error($model,'id_entity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'latitud'); ?>
		<?php echo $form->textField($model,'latitud',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'latitud'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'longitud'); ?>
		<?php echo $form->textField($model,'longitud',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'longitud'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_localizaion'); ?>
		<?php echo $form->textField($model,'fecha_localizaion'); ?>
		<?php echo $form->error($model,'fecha_localizaion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direccion_aprox'); ?>
		<?php echo $form->textArea($model,'direccion_aprox',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'direccion_aprox'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->