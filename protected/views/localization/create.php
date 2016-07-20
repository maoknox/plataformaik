<?php
/* @var $this LocalizationController */
/* @var $model Localization */

$this->breadcrumbs=array(
	'Localizations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Localization', 'url'=>array('index')),
	array('label'=>'Manage Localization', 'url'=>array('admin')),
);
?>

<h1>Create Localization</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>