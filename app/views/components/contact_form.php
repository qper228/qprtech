<?php

use app\models\forms\ContactForm;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/** @var yii\web\View $this */

$model = new ContactForm();
?>

<div class="row">
    <div class="col-lg-8">
        <?php $form = ActiveForm::begin([
            'id' => 'contact-form',
            'layout' => 'default',
            'action' => ['site/contact'],
        ]); ?>

        <div class="form-row">
            <div class="form-group col-md-6">
                <?= $form->field($model, 'name')->textInput(['placeholder' => 'Your name']) ?>
            </div>
            <div class="form-group col-md-6">
                <?= $form->field($model, 'email')->input('email', ['placeholder' => 'Your email']) ?>
            </div>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'phone')->textInput(['placeholder' => 'Phone number']) ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'body')->textarea(['rows' => 5, 'placeholder' => 'Your message (optional)']) ?>
        </div>

        <div class="form-group">
            <?= $form->field($model, 'verifyCode')->widget(\yii\captcha\Captcha::class, [
                'options' => ['class' => 'form-control'],
                'captchaAction' => 'site/captcha',
            ]) ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Send Message', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>