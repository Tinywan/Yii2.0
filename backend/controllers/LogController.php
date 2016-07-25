<?php

namespace backend\controllers;

use Yii;
use yii\base\ErrorException;
use yii\web\Controller;
use backend\models\Student;
use yii\log\FileTarget;

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

    /**
     * Yii2.0自定义日志文件写日志
     * @throws \yii\base\InvalidConfigException
     */
   public function actionLog(){
       $time = microtime(true);
       $log = new FileTarget();

       $log->logFile = Yii::$app->getRuntimePath().'/logs/test.log';
       $log->messages[] = ['test213213',1,'appliaction321321',$time];
       $log->export();
   }

}
