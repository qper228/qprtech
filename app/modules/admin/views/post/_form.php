<?php

use app\models\db\BlogCategory;
use app\models\db\Language;
use app\models\db\Post;
use kartik\editors\Codemirror;
use kartik\editors\Summernote;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-9">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'preview')->textarea(['rows' => 3]) ?>
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
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'languageId')->dropDownList(Language::getList()) ?>
            <?= $form->field($model, 'categoryId')->dropDownList(BlogCategory::getList()) ?>
            <?= $form->field($model, 'views')->textInput(['type' => 'number']) ?>
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
            <?= $form->field($model, 'isHidden')->checkbox() ?>
            <?= $form->field($model, 'isEditorsPick')->checkbox() ?>
        </div>
    </div>

    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
