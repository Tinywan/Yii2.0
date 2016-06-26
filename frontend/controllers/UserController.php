<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 2016/6/19
 * Time: 17:08
 */

namespace frontend\controllers;

use yii\web\Response;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'frontend\models\User';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        //RESTful APIs 同时支持JSON和XML格式
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_XML;

        return $behaviors;
    }

//    public function actions()
//    {
//        $actions = parent::actions();
//
//        // 禁用"delete" 和 "create" 操作lll
//        unset($actions['delete'], $actions['create']);
//
//        // 使用"prepareDataProvider()"方法自定义数据provider
//        //$actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
//
//        return $actions;
//    }
}