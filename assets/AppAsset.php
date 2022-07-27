<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use app\models\Language;
use app\models\Settings;
use app\models\Theme;
use Yii;
use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css',
        'css/custom.css'
    ];
    public $js = [
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];

    public function __construct($config = []) {
        $session = Yii::$app->session;
        $language = $session->get('language', false);
        if (!$language) $language = Language::findOne(['isDefault' => true])->shortcut;
        $settings = Settings::getActive($language);
        if ($settings->theme) {
            $this->js[] = $settings->theme->getJs();
            $this->css[] = $settings->theme->getCss();
        }
        parent::__construct($config);
    }
}
