<?php
/* @var $this LocalizationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Localizations',
);

$this->menu=array(
	array('label'=>'Create Localization', 'url'=>array('create')),
	array('label'=>'Manage Localization', 'url'=>array('admin')),
);
?>

<h1>Localizations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
