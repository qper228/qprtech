<?php
/** @var yii\web\View $this */
/** @var \app\models\db\Page $model */
/* @var \app\models\db\Settings $settings */

use yii\helpers\Html;

echo $this->render('@app/views/components/page_meta', [
    'model' => $model,
    'contentType' => 'article'
])
?>

<div class="container py-5">
    <?= $this->render('@app/views/components/ad', [
        'slot' => 'article-top'
    ]) ?>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <?php if ($model->image): ?>
                <div class="mb-4">
                    <img src="<?= Html::encode($model->image) ?>" class="img-fluid rounded" alt="<?= Html::encode($model->title) ?>">
                </div>
            <?php endif; ?>

            <h1 class="mb-3"><?= Html::encode($model->title) ?></h1>
            <p class="text-muted mb-4">
                <?= Yii::$app->formatter->asDate($model->createdAt) ?> |
                Views: <?= $model->views ?>
            </p>

            <?= $this->render('@app/views/components/ad', [
                'slot' => 'article-under-title'
            ]) ?>

            <div class="article-content">
                <?= $model->renderContent() ?>
            </div>
            <?= $this->render('@app/views/components/ad', [
                'slot' => 'article-bottom'
            ]) ?>
        </div>

        <div class="col-lg-4">
            <div class="sticky-top" style="top: 80px;">
                <?= $this->render('@app/views/components/ad', [
                    'slot' => 'article-side'
                ]) ?>
            </div>
        </div>
    </div>
</div>