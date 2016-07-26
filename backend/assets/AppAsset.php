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
    //一个包含该资源包CSS文件的数组， 该数组格式和 yii\web\AssetBundle::js 相同
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
    // 一个列出该资源包 依赖的其他资源包,依赖其他两个包 yii\web\YiiAsset 和 yii\bootstrap\BootstrapAsset
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    //为使JavaScript文件包含在页面head区域（JavaScript文件默认包含在body的结束处）使用以下选项
    /**
     * 当调用yii\web\View::registerJsFile()注册该包 每个 JavaScript文件时， 指定传递到该方法的选项
     * @var array
     */
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}
