<?php
/** @var \app\models\db\Page $model */

echo $this->render('@app/views/components/page_meta', [
    'model' => $model,
    'contentType' => 'website'
])
?>
<div class="container mt-3">
    <?= $this->render('@app/views/components/alerts') ?>
    <?= $model->renderContent() ?>
    <?= $model->renderContent($model->contentBottom) ?>
</div>
