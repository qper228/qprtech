<?php

use app\models\db\Ad;
use kartik\editors\Summernote;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\db\Ad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'slot')->dropDownList(Ad::slots()) ?>
            <?= $form->field($model, 'html')->widget(Summernote::class, [
                'pluginOptions' => [
                    'disableHtmlSanitizer' => true, // Disable HTML filtering
                ],
            ]); ?>
            <?= $form->field($model, 'isActive')->checkbox() ?>
        </div>
    </div>

    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
