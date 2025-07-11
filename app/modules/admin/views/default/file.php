<?php

use kartik\editors\Codemirror;
use yii\bootstrap4\Alert;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\CssForm */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Edit file';
?>

<div class="file-form">

    <?php if(Yii::$app->session->getFlash('update')){
        echo Alert::widget([
            'options' => [
                'class' => 'alert-success',
            ],
            'body' => Yii::$app->session->getFlash('update'),
        ]);
    }?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'content')->widget(Codemirror::class, [
        'useKrajeePresets' => true,
    ]); ?>

    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
