<?php
/**
 * Created by PhpStorm.
 * User: Tinywan
 * Date: 2016/5/22
 * Time: 18:22
 */
namespace backend\controllers;

use backend\modules\article\Module;
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

    /**
     *
     * @return string
     */
    public function actionEcharts(){
        return $this->render('echarts');
    }

    /**
     * 访问模块
     */
    public function actionModule(){
        /**
         *在模块中，可能经常需要获取模块类的实例来访问模块ID，模块参数，模块组件等， 可以使用如下语句来获取
         */
//        $module = Module::getInstance();
//        var_dump($module->id);
//        die;

        /**
         * 第一种方式仅在你知道模块ID的情况下有效,
         * 获取ID为 "article" 的模块
         */
        $module = \Yii::$app->getModule('article');
        // 通过模块实例调用该模块的方法
        $module->runAction('index/index');

        /**
         *  第二种方式在你知道处理请求的控制器下使用
         * 获取处理当前请求控制器所属的模块
         */
        $currentModule = Yii::$app->controller->module;
        //var_dump($currentModule->controller);

        /**
         * 一旦获取到模块实例，可访问注册到模块的参数和组件
         */
        $maxPostCount = $module->params['foo'];
        var_dump($maxPostCount);

    }

}
