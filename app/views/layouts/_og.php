<?php
/** @var $siteName */

use yii\web\View;

if (isset($title)) {
    $this->title = $title. ' | '. $siteName;
}
if (isset($metaTitle)) {
    $this->registerMetaTag(['name' => 'title', 'content' => $metaTitle]);
    $this->registerMetaTag(['name' => 'og:title', 'content' => $metaTitle]);
}
if (isset($metaDescription)) {
    $this->registerMetaTag(['name' => 'description', 'content' => $metaDescription]);
    $this->registerMetaTag(['name' => 'og:description', 'content' => $metaDescription]);
}
if (isset($keywords)) {
    $this->registerMetaTag(['name' => 'keywords', 'content' => $keywords]);
}
if (isset($image)) {
    $this->registerMetaTag(['name' => 'og:image', 'content' => $image]);
}
if (isset($index) && isset($follow)) {
    $index = $index ? 'index' : 'noindex';
    $follow = $follow ? 'follow' : 'nofollow';
    $this->registerMetaTag(['name' => 'robots', 'content' => $index.', '.$follow]);
}
if (isset($headScript)) {
    $this->registerJs($headScript, View::POS_HEAD);
}
if (isset($bodyScript)) {
    $this->registerJs($bodyScript, View::POS_END);
}
