<?php

use app\models\db\BlogCategory;
use app\models\db\BlogSubcategory;
use app\models\search\BlogSubcategorySearch;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel BlogSubcategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blog Subcategories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-subcategory-index">

    <p>
        <?= Html::a('Create Blog Subcategory', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= $this->render('@app/modules/admin/views/_partials/_alerts'); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'slug',
            [
                'attribute' => 'categoryId',
                'label' => 'Category',
                'value' => function($model){ return $model->category ? ($model->category->label ?? $model->category->title) : '-'; },
                'filter' => BlogCategory::getList(),
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, BlogSubcategory $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
