<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var \app\models\db\BlogSubcategory[] $subcategories */
/** @var string $categorySlug */
/** @var string $subcategorySlug */
/** @var string $orderBy */
/** @var string $search */

if (empty($subcategories)) return;

$route = ['/site/blog']; // adjust your route if needed
$build = function($subSlug = null) use ($route, $categorySlug, $orderBy, $search) {
    $params = [
        $route[0],
        'category' => $categorySlug ?: null,
        'orderBy'  => $orderBy ?: null,
        'search'   => $search ?: null,
    ];
    if ($subSlug) $params['subcategory'] = $subSlug;
    return Url::to($params);
};
?>

<?php if (count($subcategories) > 0){ ?>
    <ul class="nav nav-pills flex-wrap mb-3">
        <li class="nav-item">
            <a class="nav-link rounded-pill <?= $subcategorySlug ? '' : 'active' ?>"
               href="<?= Html::encode($build(null)) ?>" data-pjax="1">All</a>
        </li>

        <?php foreach ($subcategories as $s): ?>
            <?php
            $slug   = $s->slug ?: (string)$s->id;
            $active = $subcategorySlug === $slug;
            ?>
            <li class="nav-item">
                <a class="nav-link rounded-pill <?= $active ? 'active' : '' ?>"
                   href="<?= Html::encode($build($slug)) ?>" data-pjax="1">
                    <?= Html::encode($s->shortTitle ?: $s->title) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php } ?>
