<?php

/* @var $this yii\web\View */
/* @var $model \app\models\db\UserDAO */

$this->title = 'Create User';
$this->params['breadcrumbs'][0] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][1] = $this->title;
?>
<div class="user-dao-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
