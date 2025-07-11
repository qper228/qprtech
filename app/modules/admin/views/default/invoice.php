<?php

use kartik\editors\Codemirror;
use yii\bootstrap4\Alert;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\InvoiceForm */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Generate invoice';
?>
<div class="invoice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'firstName')->textInput() ?>
    <?= $form->field($model, 'lastName')->textInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>
    <?= $form->field($model, 'amount')->textInput(['type' => 'number']) ?>

    <div class="form-group text-right">
        <?= Html::submitButton('Generate link', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
