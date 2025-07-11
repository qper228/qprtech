<?php

namespace app\widgets;

use yii\bootstrap4\Widget;
use yii\helpers\Html;

class Socials extends Widget
{
    public $socials = [];

    private function renderSocials()
    {
        $socials = '';
        foreach ($this->socials as $social) {
            $socials .= $social->render();
        }
        return $socials;
    }

    public function run()
    {
        echo Html::tag(
            'div',
            $this->renderSocials(),
            ['class' => 'socials']
        );
    }

}