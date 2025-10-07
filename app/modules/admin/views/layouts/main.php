<?php
/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AdminAsset;
use app\models\db\Contact;
use app\models\db\User;
use app\modules\admin\utils\Components;
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;

AdminAsset::register($this);
$adminUser = User::findOne(Yii::$app->user->id);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<?php $this->beginBody() ?>

<div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <?= Html::img('@web/static/dist/img/AdminLTELogo.png', [
            'class' => 'animation__wobble',
            'width' => 60,
            'height' => 60,
            'alo' => 'AdminLTELogo'
        ])?>
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <?= Html::a('Home', ['/admin'], ['class' => 'nav-link']) ?>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->

            <!-- Messages Dropdown Menu -->

            <!-- Notifications Dropdown Menu -->

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
            <li class="nav-item">
                <?= Html::a('<i class="fas fa-sign-out-alt"></i>', ['/site/logout'], [
                    'class' => 'nav-link',
                    'data' => [
                        'method' => 'post'
                    ]
                ]) ?>
            </li>
        </ul>
    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?= Url::home(true) ?>" class="brand-link" target="_blank">
            <?=Html::img('@web/static/dist/img/AdminLTELogo.png', [
                'alt' => 'logo',
                'class' => 'brand-image img-circle elevation-3',
                'style' => [
                    'opacity' => .8
                ]
            ])?>
            <span class="brand-text font-weight-light">QPRTech</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <?= $adminUser->image(0, [
                        'class' => 'avatar'
                    ]) ?>
                </div>
                <div class="info">
                    <?= Html::a($adminUser->getName(), 'https://github.com/qper228', [
                        'class' => 'd-block',
                        'target' => '_blank'
                    ])?>
                </div>
            </div>

            <!-- SidebarSearch Form -->

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-header">NAVIGATION</li>
                    <?= Components::navLi('ad', 'Ads', '/admin/ad') ?>
                    <?= Components::navLi('blog', 'Blog Posts', '/admin/post') ?>
                    <?= Components::navLi('list', 'Blog Categories', '/admin/blog-category') ?>
                    <?= Components::navLi('list', 'Blog Subcategories', '/admin/blog-subcategory') ?>
                    <?= Components::navLi('at', 'Contacts', '/admin/contact/index', Contact::find()->count()) ?>
                    <?= Components::navLi('file-code', 'CSS', '/admin/default/css') ?>
                    <?= Components::navLi('file', 'Pages', '/admin/page') ?>
                    <?= Components::navLi('paint-roller', 'Themes', '/admin/theme') ?>
                    <?= Components::navLi('bars', 'Site sections', '/admin/section') ?>
                    <?= Components::navLi('globe', 'Social networks', '/admin/social') ?>
                    <?= Components::navLi('wrench', 'Settings', '/admin/settings') ?>
                    <?= Components::navLi('language', 'Languages', '/admin/language') ?>
                    <?= Components::navLi('robot', 'Robots.txt', '/admin/default/robots') ?>
                    <?= Components::navLi('upload', 'Uploads', '/admin/default/uploads') ?>
                    <?= Components::navLi('users', 'Users', '/admin/user') ?>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><?= $this->title ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <?= Breadcrumbs::widget([
                            'homeLink' => [
                                'label' => 'Admin',
                                'url' => '/admin',
                            ],
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <?= $content ?>
            </div>
        </section>
    </div>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>

    <!-- Main Footer -->
    <footer class="main-footer">
        <strong>
            Copyright &copy; 2014-<?= date('Y') ?> <?= Html::a('AdminLTE.io', 'https://adminlte.io', [
                'target' => '_blank'
            ]) ?>.
        </strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.2.0
        </div>
    </footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
