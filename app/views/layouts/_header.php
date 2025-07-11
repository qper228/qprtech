<?php
/** @var array $items */
/** @var string $brandLabel */
/** @var string $brandUrl */
/** @var string $navbarClass */
/** @var string $navbarAlign */
/** @var string $footer */

use app\widgets\DrawerNavigation;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => $brandLabel,
        'brandUrl' => $brandUrl,
        'options' => [
            'class' => $navbarClass,
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav '.$navbarAlign],
        'items' => $items,
        'encodeLabels' => false,
    ]);
    NavBar::end();
    echo DrawerNavigation::widget([
        'brandLabel' => $brandLabel,
        'brandUrl' => $brandUrl,
        'items' => $items,
        'footer' => $footer
    ]);
    ?>
</header>