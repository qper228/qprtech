<?php

/* @var $this yii\web\View */
/* @var $model \app\models\db\Ad */

$this->title = 'Update Ad: ' . $model->getSlotDisplay();
$this->params['breadcrumbs'][] = ['label' => 'Ads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->getSlotDisplay(), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="page-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
