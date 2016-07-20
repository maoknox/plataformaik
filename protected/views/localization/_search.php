<?php
/* @var $this LocalizationController */
/* @var $model Localization */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_localization'); ?>
		<?php echo $form->textField($model,'id_localization'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_entity'); ?>
		<?php echo $form->textField($model,'id_entity'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'latitud'); ?>
		<?php echo $form->textField($model,'latitud',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'longitud'); ?>
		<?php echo $form->textField($model,'longitud',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_localizaion'); ?>
		<?php echo $form->textField($model,'fecha_localizaion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'direccion_aprox'); ?>
		<?php echo $form->textArea($model,'direccion_aprox',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->