<?php
/**
 * Created by PhpStorm.
 * User: Tinywan
 * Date: 2016/5/22
 * Time: 18:22
 */
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Student;

class ExtendsController extends Controller
{
    public function actionIndex(){
       echo 'ExtendsController';
        // 获取登陆用户自己的ID信息
        $logUserId = Yii::$app->user->getId();
        // 判断是否是游客
        $logIsGuest = Yii::$app->user->getIsGuest();
        //返回标识对象与当前登录的用户
        $getIdentity = Yii::$app->user->getIdentity();
        $loginRequired = Yii::$app->user->loginRequired();
        var_dump($getIdentity);
    }

    /**
     *
     */
    public function actionCarousel(){
        return $this->render('carousel');
    }
}
