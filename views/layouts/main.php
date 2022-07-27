<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\ButtonDropdown;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

AppAsset::register($this);

$navigation = $this->params['navigation'];
$console = $this->params['console'];
$footerNavigation = $this->params['footerNavigation'];
$settings = $this->params['settings'];
$socials = $this->params['socials'];

$navbarClass = 'navbar navbar-expand-md fixed-top ';
if ($settings->theme) {
    $navbarClass .= $settings->theme->navbarColor;
} else {
    $navbarClass .= 'bg-light navbar-light';
}

$log = var_export($console, true);
$this->registerJs('console.log(`'.$log.'`)');
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => $settings->favicon])
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web'.$settings->logo, [
            'width' => $settings->logoWidth
        ]),
        'brandUrl' => $settings->logoUrl,
        'options' => [
            'class' => $navbarClass,
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav '.$settings->navAlign],
        'items' => $navigation,
        'encodeLabels' => false,
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="wrapper">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <?= $footerNavigation ?>
        <div class="socials">
            <?php foreach ($socials as $social) {
                echo $social->render();
            } ?>
        </div>
        <div class="footer-disclaimer">
            <?= $settings->footerText ?>
        </div>
        <small><?= $settings->siteName ?> © <?= date('Y') ?> <br> All rights reserved</small>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
