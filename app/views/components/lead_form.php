<?php

use app\models\forms\LeadForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$model = new LeadForm();
?>

<?php $form = ActiveForm::begin([
    'action' => ['/site/lead'],
    'method' => 'post',
    'options' => ['class' => 'form-row justify-content-center'],
]); ?>

    <div class="col-md-6 mb-2">
        <?= $form->field($model, 'email')->textInput([
            'type' => 'email',
            'class' => 'form-control',
            'placeholder' => 'Enter your email'
        ])->label(false) ?>
    </div>

    <div class="col-auto">
        <?= Html::submitButton('Subscribe Now', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>