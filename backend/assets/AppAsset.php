<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle  //注册外部JS文件
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'statics/css/bootstrap.min.css',
        'statics/css/jquery.mmenu.css',
        'statics/css/font-awesome.min.css',
        'statics/css/climacons-font.css',
        'statics/css/style.min.css',
    ];
    public $js = [
        'statics/js/SmoothScroll.js',
        'statics/js/jquery.mmenu.min.js',
        'statics/js/core.min.js',
        'statics/js/index.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
