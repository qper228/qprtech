<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Html;

AppAsset::register($this);

$language = $this->params['language'];
if ($language == 'gb') $language = 'en';
$log = var_export($this->params['console'], true);

$this->registerJs("console.log(`$log`)");
$this->registerLinkTag([
    'rel' => 'icon',
    'type' => 'image/png',
    'href' => $this->params['favicon']
]);
$this->registerJs($this->params['headScript'], \yii\web\View::POS_HEAD);
$this->registerJs($this->params['bodyScript'], \yii\web\View::POS_END);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= $language ?>" class="h-100" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script>const LANG =  "<?= $language ?>";</script>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>
    <?= $this->params['header'] ?>
    <main role="main" class="flex-shrink-0">
        <div class="wrapper">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>
    <?= $this->params['footer'] ?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
