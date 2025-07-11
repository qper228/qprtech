<?php
/** @var $title */
/** @var $content */
/** @var $orderBy */
/** @var $categorySlug */

use yii\bootstrap4\ButtonDropdown;

$labelMap = [
    'createdAt' => 'Latest',
    'views' => 'Most Popular',
    'isEditorsPick' => 'Editor\'s Pick'
];

$label = $labelMap[$orderBy] ?? 'Latest';

?>
<div class="d-flex justify-content-between  align-items-center mb-2">
    <h2 class="m-0"><?= $title ?></h2>
    <div class="d-flex flex-row align-items-center">
        <label class="text-nowrap m-0 pr-2" for="dropdownMenuLink">Sort by:</label>
        <?= ButtonDropdown::widget([
            'label' => $label,
            'options' => ['class' => 'blog-dropdown'],
            'dropdown' => [
                'items' => [
                    ['label' => 'Latest', 'url' => [
                        'site/blog',
                        'orderBy' => 'createdAt',
                        'category' => $categorySlug
                    ]],
                    ['label' => 'Most Popular', 'url' => [
                        'site/blog',
                        'orderBy' => 'views',
                        'category' => $categorySlug
                    ]],
                    ['label' => 'Editor\'s Pick', 'url' => [
                        'site/blog',
                        'orderBy' => 'isEditorsPick',
                        'category' => $categorySlug
                    ]],
                ],
            ],
        ]) ?>
    </div>
</div>
<?= $content ?>