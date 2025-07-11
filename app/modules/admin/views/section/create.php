<?php

/* @var $this yii\web\View */
/* @var $model \app\models\db\Section */

$this->title = 'Create Section';
$this->params['breadcrumbs'][] = ['label' => 'Sections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$model->isActive = true;
?>
<div class="section-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
