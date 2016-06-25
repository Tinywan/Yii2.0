<?php

namespace frontend\modules\user;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\user\controllers';

    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = false;
        // custom initialization code goes here
    }
}
