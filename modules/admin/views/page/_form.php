<?php

use app\models\Language;
use app\models\Page;
use app\models\Section;
use kartik\editors\Codemirror;
use kartik\editors\Summernote;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Page */
/* @var $form yii\widgets\ActiveForm */
if (!$model->sectionId) $model->sectionId = '';
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-8">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'shortTitle')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <?= $form->field($model, 'content')->widget(Summernote::class, [
                'useKrajeePresets' => true,
            ]); ?>
            <?= $form->field($model, 'headScript')->widget(Codemirror::class, [
                'useKrajeePresets' => true,
            ]); ?>
            <?= $form->field($model, 'bodyScript')->widget(Codemirror::class, [
                'useKrajeePresets' => true,
            ]); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'languageId')->dropDownList(Language::getList()) ?>
            <?= $form->field($model, 'sectionId')->dropDownList(Page::getSections()) ?>
            <?= $form->field($model, 'orderNumber')->textInput(['type' => 'number']) ?>
            <?= $form->field($model, 'file')->fileInput() ?>
            <?php if (!$model->isNewRecord && $model->image) {
                echo $model->image('100%');
            } ?>
            <?= $form->field($model, 'metaTitle')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'metaDescription')->textarea(['rows' => 3]) ?>
            <?= $form->field($model, 'keywords')->textarea(['rows' => 3]) ?>
            <?= $form->field($model, 'isIndex')->checkbox() ?>
            <?= $form->field($model, 'isFollow')->checkbox() ?>
            <?= $form->field($model, 'isHomePage')->checkbox() ?>
            <?= $form->field($model, 'isHidden')->checkbox() ?>
        </div>
    </div>

    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
