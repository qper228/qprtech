<?php
/** @var $slot */

use app\models\db\Ad;

$ad = Ad::findOne(['slot' => $slot, 'isActive' => true]);
if ($ad) {
    echo $ad->html;
}