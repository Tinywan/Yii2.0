<?php
/**
 * Created by PhpStorm.
 * User: Tinywan
 * Date: 2016/5/22
 * Time: 18:22
 */
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Student;

class ExtendsController extends Controller
{
    public function actionIndex(){
       echo 'ExtendsController';
    }

    /**
     *
     */
    public function actionCarousel(){
        return $this->render('carousel');
    }
}
