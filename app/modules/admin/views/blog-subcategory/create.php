<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\BlogSubcategory */

$this->title = 'Create Blog Subcategory';
$this->params['breadcrumbs'][] = ['label' => 'Blog Subcategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-subcategory-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
