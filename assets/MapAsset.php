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
class MapAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = ['position' => \yii\web\View::POS_END];
    public $css = [];
    public $js = [
        // 'https://maps.googleapis.com/maps/api/js?key=AIzaSyD28VkBTOJX4ibh16ES3hRYtk2wUiiR2zE&libraries=places',
        // 'js/map.js',
        // 'https://maps.googleapis.com/maps/api/js?key=AIzaSyD28VkBTOJX4ibh16ES3hRYtk2wUiiR2zE&libraries=places&callback=initMap'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',

        'yii\bootstrap4\BootstrapAsset',
    ];
}
