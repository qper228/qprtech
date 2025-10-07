<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\BlogCategory */

$this->title = 'Update Blog Subcategory: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Blog Subcategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="blog-category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
