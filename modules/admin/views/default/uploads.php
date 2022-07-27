<?php

use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Alert;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $files array */
/* @var $model app\modules\admin\models\UploadForm */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Upload files';
?>

<div class="row">
    <div class="col-md-12">
        <?php if(Yii::$app->session->getFlash('update')){
            echo Alert::widget([
                'options' => [
                    'class' => 'alert-success',
                ],
                'body' => Yii::$app->session->getFlash('update'),
            ]);
        }?>
    </div>
    <div class="col-md-12">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
        <?= FileInput::widget([
            'model' => $model,
            'attribute' => 'files[]',
            'options' => ['multiple' => true]
        ]); ?>
        <?php ActiveForm::end() ?>
    </div>
    <div class="col-md-12">
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Link</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($files as $file) {?>
                <tr>
                    <td><?= $file ?></td>
                    <td>
                        <?= Html::textInput(
                                $file,
                                Url::to('@web/uploads/'.$file, true),
                                ['style' => [
                                    'width' => '100%'
                                ]]
                        ) ?>
                    </td>
                    <td>
                        <?= Html::a(
                                '<i class="nav-icon fas fa-trash"></i>',
                                ['/admin/default/remove-file', 'file' => $file],
                                [
                                    'class' => 'btn btn-sm btn-warning',
                                    'data' => [
                                        'confirm' => 'Are you really want to delete file?',
                                        'method' => 'post'
                                    ]
                                ]
                        ) ?>
                        <?= Html::a(
                            '<i class="nav-icon fas fa-eye"></i>',
                            Url::to('@web/uploads/'.$file, true),
                            [
                                'class' => 'btn btn-sm btn-default',
                                'target' => '_blank'
                            ]
                        ) ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

