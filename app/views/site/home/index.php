<?php

/** @var yii\web\View $this */
/** @var \app\models\db\Page $model */
/** @var $pageTitle */
/** @var $content */
/** @var $contentBottom */
/** @var $latestPosts */
/** @var $popularPosts */
/** @var $editorsPosts */
/** @var array $featured */

echo $this->render('@app/views/components/page_meta', [
    'model' => $model,
    'contentType' => 'website'
])

?>
<div class="container pt-4">
    <?= $this->render('@app/views/components/alerts') ?>
    <?= $this->render('@app/views/components/ad', [
        'slot' => 'home-top'
    ]) ?>
    <?= $this->render('@app/views/components/intro', [
        'pageTitle' => $pageTitle,
        'content' => $content
    ]) ?>
    <?= $this->render('@app/views/components/ad', [
        'slot' => 'under-hero'
    ]) ?>
    <?php if (count($latestPosts)) {
        echo $this->render('_posts/latest_posts', [
            'posts' => $latestPosts,
        ]);
    } ?>
    <?= $this->render('@app/views/components/ad', [
        'slot' => 'under-latest'
    ]) ?>
    <?php if (count($popularPosts)) {
        echo $this->render('_posts/posts', [
            'posts' => $popularPosts,
            'title' => 'Popular Articles',
            'sort' => 'views'
        ]);
    } ?>
    <?= $this->render('@app/views/components/ad', [
        'slot' => 'under-popular'
    ]) ?>
    <?if (count($editorsPosts)) {
        echo $this->render('_posts/posts', [
            'posts' => $editorsPosts,
            'title' => 'Editor\'s pick',
            'sort' => 'isEditorsPick'
        ]);
    } ?>
    <?= $this->render('@app/views/components/ad', [
        'slot' => 'under-editors'
    ]) ?>
    <?= $contentBottom ?>
    <?= $this->render('@app/views/components/ad', [
        'slot' => 'home-bottom'
    ]) ?>
</div>