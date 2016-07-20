<?php
/* @var $this LocalizationController */
/* @var $data Localization */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_localization')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_localization), array('view', 'id'=>$data->id_localization)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_entity')); ?>:</b>
	<?php echo CHtml::encode($data->id_entity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('latitud')); ?>:</b>
	<?php echo CHtml::encode($data->latitud); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('longitud')); ?>:</b>
	<?php echo CHtml::encode($data->longitud); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_localizaion')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_localizaion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direccion_aprox')); ?>:</b>
	<?php echo CHtml::encode($data->direccion_aprox); ?>
	<br />


</div>