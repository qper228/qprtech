<?php

namespace app\widgets;

use yii\bootstrap4\Widget;
use yii\helpers\Html;

class Copyright extends Widget
{
    public $siteName;

    public function run()
    {
        echo Html::tag(
            'small',
            $this->siteName.'  ©  '.date('Y').Html::tag('br').'All rights reserved'
        );
    }
}