<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 2016/6/19
 * Time: 18:28
 */

namespace frontend\modules\articel\controllers;

use yii\rest\ActiveController;
use yii\web\Response;

class ArticleController extends ActiveController
{
    public $modelClass = 'frontend\models\Article';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        //RESTful APIs 同时支持JSON和XML格式
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;

        return $behaviors;
    }

    //    public function actions()
//    {
//        $actions = parent::actions();
//
//        // 禁用"delete" 和 "create" 操作
//        unset($actions['delete'], $actions['create']);
//
//        // 使用"prepareDataProvider()"方法自定义数据provider
//        //$actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
//
//        return $actions;
//    }
}