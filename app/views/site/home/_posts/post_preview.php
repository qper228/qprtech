<?php
/** @var Post $post */

use app\models\db\Post;
use yii\helpers\Html;

?>

<div class="row">
    <div class="col-md-3">
        <div class="post-card-image" style="background-image: url('<?= $post->image ?? Yii::getAlias('@web/img/default/no-image.png') ?>'); height: 75px;"></div>
    </div>
    <div class="col-md-9">
        <span class="badge badge-secondary"><?= $post->category->label ?></span>
        <p class="post-card-title"><?= $post->title ?></p>
    </div>
</div>
