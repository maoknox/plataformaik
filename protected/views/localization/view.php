<?php
/* @var $this LocalizationController */
/* @var $model Localization */

$this->breadcrumbs=array(
	'Localizations'=>array('index'),
	$model->id_localization,
);

$this->menu=array(
	array('label'=>'List Localization', 'url'=>array('index')),
	array('label'=>'Create Localization', 'url'=>array('create')),
	array('label'=>'Update Localization', 'url'=>array('update', 'id'=>$model->id_localization)),
	array('label'=>'Delete Localization', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_localization),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Localization', 'url'=>array('admin')),
);
?>

<h1>View Localization #<?php echo $model->id_localization; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_localization',
		'id_entity',
		'latitud',
		'longitud',
		'fecha_localizaion',
		'direccion_aprox',
	),
)); ?>
