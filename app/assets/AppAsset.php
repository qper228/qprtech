<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use app\models\db\Language;
use app\models\db\Settings;
use Yii;
use yii\base\InvalidConfigException;
use yii\web\AssetBundle;
use yii\web\View;

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
        'https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css',
        '@web/css/site.css',
        '@web/css/custom.css',
		'@web/css/navigation.css',
    ];
    public $js = [
        'https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js',
		'js/main.js',
        'js/navigation.js',
        'js/search-pjax.js',
        'js/cookies.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        '\yii\web\JqueryAsset'
    ];

    private $headJs = [
//        '@web/js/analytics/gtm.js',
//        '@web/js/analytics/tt.js',
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

    /**
     * @throws InvalidConfigException
     */
    public function init() {
        parent::init();
        foreach ($this->headJs as $js) {
            Yii::$app->view->registerJsFile(
                $js,
                ['position' => View::POS_HEAD]
            );
        }
    }
}
