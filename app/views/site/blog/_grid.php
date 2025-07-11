<?php
/** @var yii\web\View $this */
/** @var $models */
/** @var $pagination */

use yii\helpers\Html;
use yii\widgets\Pjax;
?>


<?php Pjax::begin(['id' => 'pjax-search-results']) ?>
<div class="row">
    <?php foreach ($models as $model) { ?>
        <div class="col-md-4">
            <?= Html::a($this->render('@app/views/components/post', ['model' => $model]), ['site/post', 'slug' => $model->slug]) ?>
        </div>
    <?php } ?>
</div>
<?= $this->render('@app/views/components/pagination', [
    'pagination' => $pagination
]) ?>
<?php Pjax::end(); ?>
