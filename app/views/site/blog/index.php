<?php
/** @var yii\web\View $this */
/** @var \app\models\db\Post $model */
/** @var $ogTags */
/** @var $categorySlug */
/** @var $orderBy */
/** @var $subcategories */
/** @var $categories */
/** @var $title */
/** @var $content */
/** @var $contentBottom */
/** @var $models */
/** @var $pagination */
/** @var $currentCategory */
/** @var $contextModel */

echo $this->render('@app/views/components/page_meta', [
    'model' => $contextModel,
    'contentType' => 'article'
])

?>
<div class="container pt-4">
    <?= $this->render('@app/views/components/ad', [
        'slot' => 'blog-top'
    ]) ?>
    <?= $this->render('@app/views/components/alerts') ?>
    <div class="row">
        <div class="col-md-2 d-none d-sm-block">
            <?= $this->render('_categories', [
                'categories' => $categories,
                'categorySlug' => $categorySlug,
            ]) ?>
            <?= $this->render('@app/views/components/ad', [
                'slot' => 'blog-categories'
            ]) ?>
        </div>
        <div class="col-md-10">
            <?= $this->render('_header', [
                'categories' => $categories,
                'title' => $title,
                'orderBy' => $orderBy,
                'categorySlug' => $categorySlug,
                'content' => $content
            ]) ?>
            <?= $this->render('@app/views/components/ad', [
                'slot' => 'blog-hero'
            ]) ?>
            <?= $this->render('@app/views/components/search_input', [
                'appendRight' => $this->render('_dropdown', [
                    'categories' => $categories
                ])
            ]) ?>

            <?= $this->render('_subcategories', [
                'subcategories'   => $subcategories,
                'categorySlug'    => $categorySlug,
                'subcategorySlug' => $subcategorySlug ?? '',
                'orderBy'         => $orderBy,
                'search'          => \Yii::$app->request->get('search', ''),
            ]) ?>

            <?= $this->render('_grid', [
                'models' => $models,
                'pagination' => $pagination,
            ]) ?>
            <?= $this->render('@app/views/components/ad', [
                'slot' => 'under-articles'
            ]) ?>
            <?= $contentBottom ?>
            <?= $this->render('@app/views/components/ad', [
                'slot' => 'blog-bottom'
            ]) ?>
        </div>
    </div>
</div>