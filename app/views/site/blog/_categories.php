<?php
/** @var $categories */
/** @var $categorySlug */

use yii\helpers\Html;

?>

<p>Blog Categories</p>
<ul class="list-group">
    <li class="list-group-item">
        <?= Html::a(
            'All Categories',
            [
                'site/blog',
            ]
        ) ?>
    </li>
    <?php foreach ($categories as $category) { ?>
        <li class="list-group-item <?= $category->slug === $categorySlug ? 'active' : '' ?>">
            <?= Html::a(
                $category->label,
                [
                    'site/blog',
                    'category' => $category->slug
                ]
            ) ?>
        </li>
    <?php } ?>
</ul>
