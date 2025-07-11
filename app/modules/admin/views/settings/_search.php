<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\search\SettingsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'label') ?>

    <?= $form->field($model, 'languageId') ?>

    <?= $form->field($model, 'themeId') ?>

    <?= $form->field($model, 'siteName') ?>

    <?php // echo $form->field($model, 'footerText') ?>

    <?php // echo $form->field($model, 'navAlign') ?>

    <?php // echo $form->field($model, 'isActive') ?>

    <?php // echo $form->field($model, 'logo') ?>

    <?php // echo $form->field($model, 'favicon') ?>

    <?php // echo $form->field($model, 'languageEnabled') ?>

    <?php // echo $form->field($model, 'logoUrl') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
