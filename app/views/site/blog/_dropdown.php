<?php
/** @var $categories */

use yii\bootstrap4\ButtonDropdown;

$mobileCategories = [];
foreach ($categories as $category) {
    $mobileCategories[] = [
        'label' => $category->label,
        'url' => [
            'site/blog',
            'category' => $category->slug
        ]
    ];
}
?>

<div class="input-group-append d-block d-sm-none">
    <div class="input-group-text">
        <?= ButtonDropdown::widget([
            'label' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
              <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/>
            </svg>',
            'options' => ['class' => 'blog-dropdown'],
            'encodeLabel' => false,
            'dropdown' => [
                'items' => $mobileCategories,
            ],
        ]) ?>
    </div>
</div>
