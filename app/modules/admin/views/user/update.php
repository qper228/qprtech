<?php

/* @var $this yii\web\View */
/* @var $model \app\models\db\UserDAO */

$this->title = 'Update User: ' . $model->email;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->email, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-dao-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
