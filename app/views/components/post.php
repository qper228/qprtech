<?php
/** @var Post $model */

use app\models\db\Post;

if (isset($size)) {
    switch ($size) {
        case 'sm':
            $height = 200;
            break;
        case 'md':
            $height = 235;
            break;
        default:
            $height = 200;
    }
} else {
    $height = 200;
}
?>

<div class="post-card">
    <div class="post-card-image" style="background-image: url('<?= $model->image ?? Yii::getAlias('@web/img/default/no-image.png') ?>'); height: <?= $height ?>px;"></div>
    <span class="badge badge-secondary"><?= $model->category->label ?></span>
    <h5 class="post-card-title"><?= $model->title ?></h5>
    <p class="post-card-preview"><?= $model->preview ?></p>
    <p class="post-card-date"><?= date("F j, Y", strtotime($model->createdAt)) ?></p>
</div>
