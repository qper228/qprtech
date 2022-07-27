<?php

use app\models\Language;
use app\models\Section;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Section */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="section-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'languageId')->dropDownList(Language::getList()) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'position')->dropDownList(Section::getPositions()) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'orderNumber')->textInput([
                'type' => 'number'
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'class')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'newTab')->checkbox() ?>
            <?= $form->field($model, 'isActive')->checkbox() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'scrollTo')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
