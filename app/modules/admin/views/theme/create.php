<?php

/* @var $this yii\web\View */
/* @var $model \app\models\db\Theme */

$this->title = 'Create Theme';
$this->params['breadcrumbs'][] = ['label' => 'Themes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$model->isActive = true;
?>
<div class="theme-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
