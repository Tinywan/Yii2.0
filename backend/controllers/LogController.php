<?php

namespace backend\controllers;

use Yii;
use yii\base\ErrorException;
use yii\web\Controller;
use backend\models\Student;

/**
 * Yii日志学习
 */
class LogController extends Controller
{
   public function actionIndex(){
       Yii::trace('start calculating average revenue',__METHOD__);
       try{
            10/0;
       }catch (ErrorException $e){
           Yii::warning('Tried divding by zero');
       }
   }

}
