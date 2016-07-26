<?php

namespace backend\controllers;


use Yii;

use yii\web\Controller;


/**
 * NodeController implements the CRUD actions for Node model.
 */
class RequestController extends Controller
{
    public function actionParams(){
        $language = isset($_SESSION['language']) ? $_SESSION['language'] : null;
        $param = Yii::$app->request->userIP;
        var_dump($language);
    }

    public function actionIndex(){
        // $headers 是一个 yii\web\HeaderCollection 对象
        $param = Yii::$app->request->headers;
        echo Yii::$app->formatter->format('2014-01-01', 'date');
        print('1111111111');
    }

    public function actionOld()
    {
        //可调用yii\web\Response::redirect() 方法将用户浏览器跳转到一个URL地址
        //return $this->redirect('http://example.com/new', 301);
        $posts = Yii::$app->db->createCommand('SELECT * FROM USER')
            ->queryAll();
        var_dump($posts);
    }
}
