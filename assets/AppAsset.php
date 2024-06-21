<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

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
    public $baseUrl = '@web/theme';
    public $css = [
        "css/bootstrap.min.css",
        "css/icons.css",
        "css/style.css",
        '../plugin/fontawesome-free/css/all.min.css',
        
        "js/modernizr.min.js",
        'plugins/toastr/toastr.min.css',
    ];
    public $js = [
        // jQuery
        "js/popper.min.js",
        "js/bootstrap.min.js",
        "js/detect.js",
        "js/fastclick.js",
        "js/jquery.blockUI.js",
        "js/waves.js",
        "js/jquery.nicescroll.js",
        "js/jquery.slimscroll.js",
        "js/jquery.scrollTo.min.js",
        'https://cdn.jsdelivr.net/npm/sweetalert2@9',

        // App js
        "js/jquery.core.js",
        "js/jquery.app.js",
        'plugins/toastr/toastr.min.js',
        '../js/app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',

        // 'yii\bootstrap4\BootstrapAsset',
    ];
}
