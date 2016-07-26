<?php

namespace backend\controllers;

use Yii;
//use yii\web\Controller;
use yii\rest\Controller;
use backend\models\Student;

/**
 * CameraController implements the CRUD actions for Camera model.
 */
class RedisController extends Controller
{
   public function actionIndex(){
       $student = new Student();
       $student->attributes = ['name'=>'Tinywan'];
       if($student->save() == false){
           echo 'save';
       }
       echo $student->id;

       $result= Student::find()->where(['name' => 'Tinywan'])->one();
       var_dump($result);
       //$student = Student::find()->active()->all();
   }

    public function actionModule(){

    }
}
