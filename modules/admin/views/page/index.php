<?php

use app\models\Language;
use app\models\Page;
use app\models\Section;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <p>
        <?= Html::a('Create Page', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                'label' => 'Section',
                'value' => function ($data) {
                    if ($data->section) return $data->section->label;
                    return '-';
                },
                'format' => 'html',
                'attribute' => 'sectionId',
                'filter' => Section::getList()
            ],
            'isHomePage:boolean',
            'isHidden:boolean',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Page $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
