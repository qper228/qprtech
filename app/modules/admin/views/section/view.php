<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \app\models\db\Section */

$this->title = $model->label;
$this->params['breadcrumbs'][] = ['label' => 'Sections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="section-view">

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
                'label' => 'Position',
                'value' => function ($data) {
                    return $data->getPositionName();
                }
            ],
            'orderNumber',
            'class',
            'scrollTo',
            'url:url',
            'newTab:boolean',
            'isActive:boolean',
        ],
    ]) ?>

</div>
