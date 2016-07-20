<?php
/* @var $this LocalizationController */
/* @var $model Localization */

$this->breadcrumbs=array(
	'Localizations'=>array('index'),
	$model->id_localization=>array('view','id'=>$model->id_localization),
	'Update',
);

$this->menu=array(
	array('label'=>'List Localization', 'url'=>array('index')),
	array('label'=>'Create Localization', 'url'=>array('create')),
	array('label'=>'View Localization', 'url'=>array('view', 'id'=>$model->id_localization)),
	array('label'=>'Manage Localization', 'url'=>array('admin')),
);
?>

<h1>Update Localization <?php echo $model->id_localization; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>