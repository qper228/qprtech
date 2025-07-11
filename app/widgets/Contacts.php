<?php

namespace app\widgets;

use yii\bootstrap4\Widget;
use yii\helpers\Html;

class Contacts extends Widget
{
    public $email;
    public $phone;

    private function renderEmail()
    {
        return Html::a(
            Html::tag(
                'i',
                null,
                ['class' => 'fa-solid fa-at']
            ).' '.$this->email,
            'mailto:'.$this->email
        );
    }

    private function renderPhone()
    {
        return Html::a(
            Html::tag(
                'i',
                null,
                ['class' => 'fa-solid fa-phone']
            ).' '.$this->phone,
            'tel:'.$this->phone
        );
    }

    public function run() {
        $emailTag = $this->email ? Html::tag('p', $this->renderEmail()) : '';
        $phoneTag = $this->phone ? Html::tag('p', $this->renderPhone()) : '';
        echo Html::tag('div', $emailTag.$phoneTag,['class' => 'contacts']);
    }
}