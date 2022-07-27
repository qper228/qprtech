<?php
/** @var $query */

use yii\bootstrap4\LinkPager;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 12,
        'forcePageParam' => false,
        'pageSizeParam' => false,
    ],
]);
$models = $dataProvider->getModels();
$pagination = $dataProvider->pagination;
?>

<div class="post-grid">
    <div class="row">
        <?php foreach ($models as $model) { ?>
            <div class="col-md-3">
                <div class="card">
                    <?= Html::img('@web'.$model->image, [
                        'class' => 'card-img-top'
                    ])?>
                    <div class="card-body">
                        <h5 class="card-title"><?= $model->title ?></h5>
                        <p class="card-text"><?= $model->preview ?></p>
                        <div class="text-center">
                            <?= Html::a('Read', ['site/post', 'slug' => $model->slug], [
                                'class' => 'btn btn-primary btn-block'
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-md-4">
            <?= LinkPager::widget([
                'pagination' => $pagination,
            ]); ?>
        </div>
    </div>
</div>
