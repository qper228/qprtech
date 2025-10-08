<?php

use app\models\db\BlogCategory;
use app\models\db\BlogSubcategory;
use app\models\db\Language;
use app\models\db\Post;
use app\models\search\PostSearch;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= $this->render('@app/modules/admin/views/_partials/_alerts'); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'class' => 'yii\bootstrap4\LinkPager'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            [
                'label' => 'Language',
                'value' => function ($data) {
                    if ($data->language) return $data->language->icon('4x3');
                    return '-';
                },
                'attribute' => 'languageId',
                'filter' => Language::getList(),
                'format' => 'html'
            ],
            [
                'label' => 'Category',
                'value' => function ($data) {
                    return $data->category->title;
                },
                'attribute' => 'categoryId',
                'filter' => BlogCategory::getList(),
            ],
            [
                'label' => 'Subcategory',
                'value' => function ($data) {
                    return $data->subcategory->title;
                },
                'attribute' => 'subcategoryId',
                'filter' => BlogSubcategory::getAll(),
            ],
            'isHidden:boolean',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Post $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
