<?php

use app\models\db\BlogCategory;
use app\models\db\Language;
use app\models\search\BlogCategorySearch;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel BlogCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blog Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-category-index">

    <p>
        <?= Html::a('Create Blog Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= $this->render('@app/modules/admin/views/_partials/_alerts'); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'label',
            'slug',
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
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, BlogCategory $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
