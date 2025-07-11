<?php

use app\models\db\Language;
use app\models\db\Settings;
use app\models\db\Theme;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel \app\models\search\SettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Settings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-index">

    <p>
        <?= Html::a('Create Settings', ['create'], ['class' => 'btn btn-success']) ?>
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
            'label',
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
                'label' => 'Theme',
                'value' => function ($data) {
                    if ($data->theme) return $data->theme->label;
                    return '-';
                },
                'attribute' => 'themeId',
                'filter' => Theme::getList(),
                'format' => 'html'
            ],
            'isActive:boolean',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Settings $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
