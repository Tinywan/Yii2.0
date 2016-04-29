<?php

namespace frontend\controllers;

use backend\models\Camera;
use backend\models\CamSet;
use backend\models\Node;
use backend\models\Times;
use frontend\models\LoginUserForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Console;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use backend\models\Company;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
{
    const TIME = '';
    const RRR = '';
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        //单位信息
        $com_model = new Company();
        $company_redis = $com_model->getCompanytRedis($id);

        //获取所有的节点信息
        $node_model = new Node();
        $node_redis = $node_model->getAllRedis($id);

        //$nodes = $node_model->find()->where('com_id = :com_id',[':com_id'=>$id])->all();
        $nodes = $node_model->find()->where('com_id = :com_id')->addParams([':com_id'=>$id])->all();

        foreach($nodes as $node){
            $node_arr[] = $node->id;
        }
        //获取节点设置时段信息
        if(isset($node_arr)){
            $time_model = new Times();
            $time_redis = $time_model->getAllRedis($node_arr);
        }else{
            $time_redis = [];
        }
        //获取所有的摄像头信息
        if(isset($node_arr)){
            $camera_model = new Camera();
            $camera_redis = $camera_model->getAllRedis($node_arr);  //这里传递的是一个数组
        }else{
            $camera_redis = [];
        }

        if(isset($camera_redis)){
            //获取的摄像头设置信息
            $camset_model = new CamSet();
            foreach($camera_redis as $cam){
                $cam_arr[] = $cam['id'];
            }
            if(isset($cam_arr)){
                $camset_redis = $camset_model->getAllRedis($cam_arr);
            }else{
                $camset_redis = [];
            }
        }else{
            $camset_redis = [];
        }
        //获取时间
        $time_info = Yii::$app->cache->redis->get('time');

        //保存信息到数组中
        $redis_arr = [
            'time' => $time_info,
            'company' => $company_redis,
            'node' => $node_redis,
            'camera' => $camera_redis,
            'node_times' => $time_redis,
            'camera_set' => $camset_redis
        ];
        //转换为json保存在本地
        $RootDir = Yii::$app->BasePath;
        $FilePath = "$RootDir/data/data.txt";
        file_put_contents($FilePath,json_encode($redis_arr));
        //$array = [1,2,3,4,5,5,5,5];
        return $this->render('main',[
            'company' => $company_redis,
        ]);
    }

    //登录判断
    public function actionLogin()
    {
        $this->layout = 'login';
        $model = new LoginUserForm();

        if ($model->load(Yii::$app->request->post())) {
            //LoginUser模型中判断当前单位信息的redis是否存在
            if($model->checkRedis()){
                Yii::$app->params['redis_host'] = $model->redis_host;
                return $this->redirect(['index', 'id' => $model->id]);
            }else{
                return $this->render('error');
            }
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionTest(){
        $model = Yii::$app->cache->redis->EXISTS('company:98'); //获取到的是一个数组
        if(empty($model)){
            return false;
        }
        return true;

        //echo $model[1];
    }

    public function actionJson(){
        $basePath = Yii::$app->basePath;
        $filePath = $basePath.'/data/data.txt';
        $fileJosn = file_get_contents($filePath);
        var_dump(json_decode($fileJosn));
        echo $filePath;
    }
}
