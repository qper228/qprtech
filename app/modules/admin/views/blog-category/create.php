<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\BlogCategory */

$this->title = 'Create Blog Category';
$this->params['breadcrumbs'][] = ['label' => 'Blog Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
