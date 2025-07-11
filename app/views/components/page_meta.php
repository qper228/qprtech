<?php

/** @var yii\web\View $this */
/** @var \app\models\abstractions\AbstractContentModel $model */

/* @var \app\models\db\Settings $settings */
/* @var string $contentType */

use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\View;

$this->title = $model->title;
$index = $model->isIndex ? 'index' : 'noindex';
$follow = $model->isFollow ? 'follow' : 'nofollow';

if ($model->metaTitle) {
    $this->registerMetaTag(['name' => 'title', 'content' => $model->metaTitle]);
    $this->registerMetaTag(['property' => 'og:title', 'content' => $model->metaTitle]);
    $this->registerMetaTag(['name' => 'twitter:title', 'content' => $model->metaTitle]);
}
if ($model->metaDescription) {
    $this->registerMetaTag(['name' => 'description', 'content' => $model->metaDescription]);
    $this->registerMetaTag(['property' => 'og:description', 'content' => $model->metaDescription]);
    $this->registerMetaTag(['name' => 'twitter:description', 'content' => $model->metaDescription]);
}
if ($model->keywords) {
    $this->registerMetaTag(['name' => 'keywords', 'content' => $model->keywords]);
}
if ($model->image) {
    $this->registerMetaTag(['property' => 'og:image', 'content' => Url::to('@web'.$model->image, true)]);
    $this->registerMetaTag(['name' => 'twitter:image', 'content' => Url::to('@web'.$model->image, true)]);
}

$this->registerMetaTag(['name' => 'robots', 'content' => $index . ', ' . $follow]);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::canonical()]);
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::canonical()]);
$this->registerMetaTag(['property' => 'og:type', 'content' => $contentType]);

$this->registerMetaTag(['name' => 'twitter:card', 'content' => 'summary_large_image']);

$this->registerJs($model->headScript, View::POS_HEAD);
$this->registerJs($model->bodyScript, View::POS_END);

$structuredData = [
    '@context' => 'https://schema.org',
    '@type' => $contentType === 'article' ? 'Article' : 'WebPage',
    'headline' => $model->metaTitle ?: $model->title,
    'description' => $model->metaDescription,
    'url' => Url::canonical(),
];

if ($model->image) {
    $structuredData['image'] = Url::to('@web' . $model->image, true);
}

if (isset($model->createdAt)) {
    $structuredData['datePublished'] = $model->createdAt;
}

if ($contentType === 'article') {
    $structuredData['author'] = [
        '@type' => 'Organization',
        'name' => Yii::$app->params['websiteName'],
    ];
}

$this->registerJs(
    "var jsonLd = " . Json::encode($structuredData) . ";
     var script = document.createElement('script');
     script.type = 'application/ld+json';
     script.text = JSON.stringify(jsonLd);
     document.head.appendChild(script);",
    View::POS_HEAD
);