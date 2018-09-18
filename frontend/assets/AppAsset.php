<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/font-awesome.min.css',
        'css/magnific-popup.css',
        'css/magnific-popup-animate.css',
        'css/site.css',
    ];
    public $js = [
        'js/jquery.magnific-popup.min.js',
        'js/scripts.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
