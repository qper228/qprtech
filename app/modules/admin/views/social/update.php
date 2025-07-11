<?php

/* @var $this yii\web\View */
/* @var $model \app\models\db\Social */

$this->title = 'Update Social: ' . ucfirst($model->icon);
$this->params['breadcrumbs'][] = ['label' => 'Socials', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => ucfirst($model->icon), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="social-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
