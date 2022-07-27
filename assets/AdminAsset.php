<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback',
        'static/plugins/fontawesome-free/css/all.min.css',
        'static/plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
        'static/dist/css/adminlte.min.css',
        'css/admin.css'
    ];
    public $js = [
//        'static/plugins/jquery/jquery.min.js',
        'static/plugins/bootstrap/js/bootstrap.bundle.min.js',
        'static/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
        'static/dist/js/adminlte.js',
        'static/plugins/jquery-mousewheel/jquery.mousewheel.js',
        'static/plugins/raphael/raphael.min.js',
        'static/plugins/jquery-mapael/jquery.mapael.min.js',
        'static/plugins/jquery-mapael/maps/usa_states.min.js',
        'static/plugins/chart.js/Chart.min.js',
//        'static/dist/js/demo.js',
//        'static/dist/js/pages/dashboard2.js',
        'js/admin.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
