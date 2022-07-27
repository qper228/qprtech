<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SectionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="section-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'label') ?>

    <?= $form->field($model, 'languageId') ?>

    <?= $form->field($model, 'position') ?>

    <?= $form->field($model, 'orderNumber') ?>

    <?php // echo $form->field($model, 'class') ?>

    <?php // echo $form->field($model, 'scrollTo') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'newTab') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
