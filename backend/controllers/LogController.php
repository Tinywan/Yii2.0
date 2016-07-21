<?php

namespace backend\controllers;

use Yii;
//use yii\web\Controller;
use yii\rest\Controller;
use backend\models\Student;

/**
 * Yii日志学习
 */
class LogController extends Controller
{
   public function actionIndex(){
        Yii::trace('start calculating average revenue');
   }
}
