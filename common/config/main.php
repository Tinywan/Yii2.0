<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\redis\Cache',   // redis 接管了yii的缓存
            'redis' => [
                'hostname' => '127.0.0.1',
                'port' => 6379,
                'database' => 0,
            ],
        ],
        // 'session' => [
        //     'class' => 'yii\redis\Session',   // redis 接管了yii的缓存
        //     'redis' => [
        //         'hostname' => '127.0.0.1',
        //         'port' => 6379,
        //         'database' => 0,
        //     ],
        // ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '127.0.0.1',
            'port' => 6379,
            'database' => 0,
        ]

    ],
];
