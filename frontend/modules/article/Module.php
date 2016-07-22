<?php

namespace frontend\modules\article;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\article\controllers';

    /**
     * 开始用户验证
     */
    public function init()
    {
        parent::init();
        //当 yii\web\User::enableSession|enableSession 是 false 的时候, 用户认证状态不能通过 sessions 在多个请求之间保持
        \yii::$app->user->enableSession;
        // custom initialization code goes here
    }
}
