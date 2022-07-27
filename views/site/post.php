<?php
/** @var yii\web\View $this */
/** @var app\models\Page $model */
/* @var app\models\Settings $settings */

use yii\helpers\Html;

$this->title = $model->title;
$this->registerMetaTag(['name' => 'title', 'content' => $model->metaTitle]);
$this->registerMetaTag(['name' => 'description', 'content' => $model->metaDescription]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->keywords]);
$this->registerMetaTag(['name' => 'og:title', 'content' => $model->metaTitle]);
$this->registerMetaTag(['name' => 'og:description', 'content' => $model->metaDescription]);
$this->registerMetaTag(['name' => 'og:image', 'content' => $model->image]);
$index = $model->isIndex ? 'index' : 'noindex';
$follow = $model->isFollow ? 'follow' : 'nofollow';
$this->registerMetaTag(['name' => 'robots', 'content' => $index.', '.$follow]);
$this->registerJs($model->headScript, \yii\web\View::POS_HEAD);
$this->registerJs($model->bodyScript, \yii\web\View::POS_END);
?>
<?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin) { ?>
    <div class="options">
        <?= Html::a(
            '<i class="fa-solid fa-pencil"></i>',
            ['/admin/post/update', 'id' => $model->id],
            ['class' => 'btn btn-sm btn-primary']
        ) ?>
    </div>
<?php } ?>
<div class="post-cover" style="background-image: url(<?= $model->image ?>)">
    <div class="caption">
        <h2><?= $model->title ?></h2>
        <p><?= $model->preview ?></p>
    </div>
</div>
<div class="container post">
    <?= $model->renderContent() ?>
</div>
