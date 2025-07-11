<?php

namespace app\widgets;

use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\Widget;

class DrawerNavigation extends Widget
{
    public $brandLabel;
    public $brandUrl;
    public $items = [];
    public $right = null;
    public $footer = null;

    private function renderBrand()
    {
        return Html::a(
            $this->brandLabel,
            $this->brandUrl,
            ['class' => 'brand-label']
        );
    }

    private function renderButton()
    {
        return Html::button(
            Html::tag(
                'i',
                null,
                ['class' => 'fa-solid fa-bars']
            ),
            [
                'class' => 'btn btn-default btn-lg',
                'id' => 'navigation-mobile-toggle'
            ]
        ) . $this->renderBrand() . Html::tag('div', $this->right, ['class' => 'pull-right']);
    }

    private function renderFooter()
    {
        return Html::tag(
            'div',
            $this->footer,
            ['class' => 'navigation-mobile-drawer-footer']
        );
    }

    private function renderContent()
    {
        return Html::tag(
            'div',
            Html::tag(
                'div',
                    Html::tag(
                        'div',
                        $this->renderBrand(),
                        ['class' => 'navigation-mobile-drawer-label']
                    ) . Nav::widget([
                    'items' => $this->items,
                    'encodeLabels' => false,
                ]),
                ['class' => 'navigation-mobile-drawer-header']
            ) . Html::tag(
                'div',
                $this->renderFooter(),
                ['class' => 'navigation-drawer-footer']
            ),
            ['class' => 'navigation-mobile-drawer-container']
        );
    }

    public function run() {
        echo Html::tag(
            'div',
            $this->renderButton(),
            [
                'class' => 'navigation-mobile',
                'id' => 'navigation-mobile'
            ]
        );
        echo Html::tag(
            'div',
            $this->renderContent(),
            [
                'class' => 'navigation-mobile-drawer',
                'id' => 'navigation-mobile-drawer'
            ]
        );
    }

}

