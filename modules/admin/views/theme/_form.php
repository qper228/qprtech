<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Theme */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="theme-form">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => false
    ]); ?>

    <div class="row">
        <div class="col-md-9">
            <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'navbarColor')->dropDownList([
                'bg-dark navbar-dark' => 'Dark',
                'bg-light navbar-light' => 'Light'
            ]) ?>
        </div>
    </div>

    <?= $form->field($model, 'fileJs')->fileInput() ?>

    <?= $form->field($model, 'fileCss')->fileInput() ?>

    <?= $form->field($model, 'isActive')->checkbox() ?>

    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
