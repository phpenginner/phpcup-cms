<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';


    public $css = [
        'static/css/bootstrap.min.css?v=3.3.5',
        'static/css/font-awesome.min.css?v=4.4.0',
        'static/css/animate.min.css',
        'static/css/style.min.css?v=4.0.0',
        'static/css/login.min.css',
    ];

    public $js = [
        'static/js/jquery.min.js?v=2.1.4',
        'static/js/bootstrap.min.js?v=3.3.5',
        'static/js/plugins/metisMenu/jquery.metisMenu.js',
        'static/js/plugins/slimscroll/jquery.slimscroll.min.js',
        'static/js/plugins/layer/layer.min.js',
        'static/js/hplus.min.js?v=4.0.0',
        'static/js/contabs.min.js',
        'static/js/plugins/pace/pace.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
