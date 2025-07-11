<?php
/** @var $pagination */

use yii\bootstrap4\LinkPager;

?>
<div class="d-flex justify-content-center">
    <?= LinkPager::widget([
        'pagination' => $pagination,
    ]); ?>
</div>
