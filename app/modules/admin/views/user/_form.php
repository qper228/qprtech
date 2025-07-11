<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\db\UserDAO */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-dao-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'firstName')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'lastName')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'file')->fileInput() ?>
            <?php if (!$model->isNewRecord && $model->avatar) {
                echo $model->image(0, [
                    'class' => 'avatar lg'
                ]);
            } ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'repeatNewPassword')->passwordInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'isAdmin')->checkbox() ?>
        </div>
    </div>
    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
