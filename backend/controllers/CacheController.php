<?php
/**
 * Created by PhpStorm.
 * User: Tinywan
 * Date: 2016/5/22
 * Time: 18:22
 */
namespace backend\controllers;

use Yii;
//use yii\web\Controller;
use yii\rest\Controller;
use backend\models\Student;

/**
 * CameraController implements the CRUD actions for Camera model.
 */
class CacheController extends Controller
{
   public function actionIndex(){
      echo '22222222222222';
   }

    /**
     * 文件缓存
     */
   public function actionDataCache(){
       // 获取缓存组件
       $cache = yii::$app->cache;

       // 往缓存中写入数据
       
   }
}
