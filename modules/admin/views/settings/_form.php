<?php

use app\models\Language;
use app\models\Section;
use app\models\Settings;
use app\models\Theme;
use kartik\editors\Summernote;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Settings */
/* @var $form yii\widgets\ActiveForm */
if (!$model->themeId) $model->themeId = '';
?>

<div class="settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'languageId')->dropDownList(Language::getList()) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'themeId')->dropDownList(Settings::getThemes()) ?>
                </div>
                <div class="col-md-12">
                    <?= $form->field($model, 'footerText')->widget(Summernote::class, [
                        'useKrajeePresets' => true,
                    ]); ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'siteName')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'navAlign')->dropDownList([
                'flex-start' => 'Start',
                'flex-end' => 'End',
                'space-between' => 'Between'
            ]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'emailSender')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, '_logo')->fileInput() ?>
            <?php if (!$model->isNewRecord && $model->logo) echo Html::img('@web'.$model->logo, ['class' => 'img-fluid']); ?>
            <?= $form->field($model, 'logoUrl')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'logoWidth')->textInput(['type' => 'number']) ?>
            <?= $form->field($model, '_favicon')->fileInput() ?>
            <?php if (!$model->isNewRecord && $model->logo) echo Html::img('@web'.$model->favicon, ['class' => 'img-fluid']); ?>
            <?= $form->field($model, 'isActive')->checkbox() ?>
            <?= $form->field($model, 'languageEnabled')->checkbox() ?>
        </div>
    </div>

    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
