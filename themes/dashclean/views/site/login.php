
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<div class='container'>
    <div class="signin-row row">
        <div class="span4"></div>
        <div class="span8">
            <div class="container-signin">
                <legend>Por favor digite los datos de ingreso</legend>
                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'login-form',
                        'enableClientValidation'=>true,
                        'enableAjaxValidation'=>true,
                        'clientOptions'=>array(
                                'validateOnSubmit'=>true,
                        ),
                )); ?>
                <p class="note">Datos con <span class="required">*</span> son requeridos.</p>
                <div class="form-inner">
                    <div class="input-prepend">
                        <?php echo $form->labelEx($model,'username'); ?>
                        <span class="add-on" rel="tooltip" title="Username" data-placement="top"><i class="icon-star"></i></span>		
                        <?php echo $form->textField($model,'username',array("placeholder"=>"Nombre Usuario")); ?>                       
                    </div>
                    <?php echo $form->error($model,'username',array('style'=>'z-index:100;color:#F00')); ?>
                    <div class="input-prepend">   
                        <?php echo $form->labelEx($model,'password'); ?>
                        <span class="add-on"><i class="icon-key"></i></span>                       
                        <?php echo $form->passwordField($model,'password',array("placeholder"=>"Contraseña")); ?>                       
                    </div>
                    <?php echo $form->error($model,'password',array('style'=>'z-index:100;color:#F00')); ?>
                </div>
                <footer class="signin-actions">
                    <?php echo CHtml::submitButton('Ingresar',array('class'=>"btn btn-primary" )); ?>
                </footer>
                <?php $this->endWidget(); ?>
            </div>
        </div>
        <div class="span3"></div>
    </div>  
<!--    <div class="signin-row row">
        <div class="span4"></div>
        <div class="span8">
            <div class="well well-small well-shadow">
                <legend class="lead">Additional Content</legend>
                Add additional content here.
            </div>
        </div>
        <div class="span8"></div>
    </div>  -->
 </div>