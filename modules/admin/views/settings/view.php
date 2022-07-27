<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Settings */

$this->title = $model->label;
$this->params['breadcrumbs'][] = ['label' => 'Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="settings-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'label',
            [
                'label' => 'Language',
                'value' => function ($data) {
                    if ($data->language) return $data->language->icon('4x3');
                    return '-';
                },
                'format' => 'html'
            ],
            [
                'label' => 'Theme',
                'value' => function ($data) {
                    if ($data->theme) return $data->theme->label;
                    return '-';
                }
            ],
            'siteName',
            'footerText:ntext',
            'navAlign',
            'isActive:boolean',
            'logo:image',
            'favicon:image',
            'languageEnabled:boolean',
            'logoUrl:url',
            'logoWidth',
            'email:email',
            'phone'
        ],
    ]) ?>

</div>
