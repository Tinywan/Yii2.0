<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'language'=>'zh-CN',
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    /*模块配置信息*/
    'modules' => [
        'user' => [
            'class' => 'frontend\modules\user\Module',
        ],
        'article' => [
            'class' => 'frontend\modules\article\Module',
        ],
    ],
    'components' => [
        // 默认可以使用session用户的登陆信息
//        'user' => [
//            'identityClass' => 'common\models\User',
//            'enableAutoLogin' => true,
//            'enableSession' => false,
////            'enableSession' => true,
////            'loginUrl' => null,
//        ],
        // 接口APi的用户认证信息i
        'user' => [
            'identityClass' => 'frontend\models\User',
            'enableAutoLogin' => true,
            'enableSession' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        //添加语言包配置
        'i18n' => [
            'translations' => [
                'common' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '/messages',
                    'fileMap' => [
                        'common' => 'common.php',
                    ],
                ],
                'power' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '/messages',
                    'fileMap' => [
                        'power' => 'power.php',
                    ],
                ],
            ],
        ],
        //URl
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '',    //如果设置了此项，那么浏览器地址栏就必须带上.html后缀，否则会报404错误
            'rules'=>[
                ['class' => 'yii\rest\UrlRule', 'controller' => 'article'],
            ],
        ],

    ],
    'params' => $params,
];
