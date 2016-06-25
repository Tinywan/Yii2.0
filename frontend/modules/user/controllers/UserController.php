<?php

namespace frontend\modules\user\controllers;

use yii\web\Controller;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;


class UserController extends Controller
{
    public $modelClass = 'frontend\models\User';

    public function actionIndex()
    {
        echo 'user Moduelsfsfdsaf';
        //return $this->render('index');
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
        ];
        return $behaviors;
    }
}
