<?php

namespace backend\modules\article;

class Module extends \yii\base\Module
{
    //如果一些控制器不再该命名空间下，可配置yii\base\Module::controllerMap属性让它们能被访问
    public $controllerNamespace = 'backend\modules\article\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
        $this->params['foo'] = 'bar';
    }
}
