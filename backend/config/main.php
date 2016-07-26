<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'language'=>'zh-CN',
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
//    'defaultRoute'=>'company/index',    //默认路由,这个加上的话，登录就会出现问题？？？？
    'bootstrap' => ['log'],
    //模块配置
    'modules' => [
        'article' => [
            'class' => 'backend\modules\article\Module',
        ],
        'wechat' => [
            'class' => 'backend\modules\wechat\weChat',
        ],
        //应用集成编辑器
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => '@webroot/path/to/uploadfolder',
            'uploadUrl' => '@web/path/to/uploadfolder',
            'imageAllowExtensions'=>['jpg','png','gif']
        ],
        
    ],
    //组件配置
    'components' => [
        //所以Yii::$app->user指的是$config组件下的user组件
        'user' => [
            //User用户组件下的identity属性即是User认证类
            'identityClass' => 'common\models\Admin',
            //只有在enableAutoLogin为true的情况下，如果选择了下次自动登录，那么就会把用户信息存储起来放到cookie中并设置cookie的有效期为3600*24*30秒，以用于下次登录
            'enableAutoLogin' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache', //默认是文件缓存
        ],
        //自定义的一个类哦
        'car' => [
            'class' => 'backend\controllers\Car'
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'file' => [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                'email' => [
                    'class' => 'yii\log\EmailTarget',
                    'levels' => ['error'],
                    'categories' => ['yii\db\*'],
                    'message' => [
                        'from' => ['log@example.com'],
                        'to' => ['admin@example.com', 'developer@example.com'],
                        'subject' => 'Database errors at example.com',
                    ],
                ],
            ],

        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],
        'smser' => [
            // 中国网建
            'class' => 'yii\smser\WebchineseSmser',
            'uid' => 'YeChuZheng',
            'key' => '85fd6d7ab14c55784df0',
            'fileMode' => false
        ],
        // 指定错误页面的输出的视图
        'errorHandler' => [
            'errorAction' => 'company/error',
        ],
        //添加语言包配置
        'i18n' => [
            'translations' => [
                'common' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '@app/messages',
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

        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'bundles' => [
                'daixianceng\echarts\EChartsAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => '//cdn.bootcss.com/echarts/3.0.0'
                ]
            ],
        ],
        //URl
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '',    //如果设置了此项，那么浏览器地址栏就必须带上.html后缀，否则会报404错误
            'rules'=>[
                '<controller:poor-per-info>/<action:get-area-list>/<pid:\d+>.html'=>'<controller>/<action>',
//                'index' => 'company/index',
//                'create' => 'company/create',
//                'edit' => 'company/edit',
//                'article/index' => 'article/article/index',
            ],
        ],
//        //使用主题
//        'view' => [
//            'theme' => [
//                'basePath' => '@app/themes/basic',
//                'baseUrl' => '@web/themes/basic',
//                'pathMap' => [
//                    '@app/views' => '@app/themes/basic',
//                ],
//            ],
//        ],

    ],
    'params' => $params,

];
