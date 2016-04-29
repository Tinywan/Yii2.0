<?php

namespace backend\controllers;

use backend\models\Times;
use backend\models\CamSet;
use backend\models\Camera;
use backend\models\Node;
use Yii;
use backend\models\search\CompanySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use backend\models\Company;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
{
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
    public function actionIndex()
    {
        $model = new Company();
        $model->scenario = 'login';

        $curPage = Yii::$app->request->get('page',1);
        $pageSize = 14;

        $name = Yii::$app->request->get('name','');
        $address = Yii::$app->request->get('address','');

        $search = ($name&&$address)?['like',$name,$address]:'';
        //
        $query = $model->find()->orderBy('id DESC');
        $data = $model->getPages($query,$curPage,$pageSize,$search);
        $pages = new Pagination([
            'totalCount' =>$data[ 'count'],
            'pageSize' => $pageSize,
        ]);
        return $this->render('index',[
            'pages'=>$pages,
            'data'=>$data
        ]);
    }

    /**
     * Displays a single Company model.
     * @param integer $id
     * @return mixed
     */
    //    public function actionDao($id){
    //        $company_arr = Company::find()->where('id = :id',[':id'=>$id])->asArray()->one();
    //        $camera_arr  = Camera::find()->where('id = :id',[':id'=>$id])->asArray()->one();
    //        var_dump($camera_arr);
    //    }

    /**
     * Displays a single Company model.
     * @param integer $id
     * @return mixed
     */
    //    public function actionView($id)
    //    {
    //        return $this->render('view', [
    //            'model' => $this->findModel($id),
    //        ]);
    //    }

    /**
     * this is result Success
     */
    public function actionCreate()
    {
        $model = new Company();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->setCompanyRedis();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    //    public function actionUpdate($id)
    //    {
    //        $model = $this->findModel($id);
    //
    //        if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //            return $this->redirect(['view', 'id' => $model->id]);
    //        } else {
    //            return $this->render('update', [
    //                'model' => $model,
    //            ]);
    //        }
    //    }

    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        /*
         *  @循环遍历删除
         *  1.先查找单位下-->摄像头是否存在--->摄像头是否已经设置
         *  2.在查找节点以及节点的时间段设置
         *  3.删除单位信息
        */

        //查找所有的节点
        $node_model = Node::find()->where('com_id = :com_id')->addParams([':com_id'=>$id])->all();
        foreach($node_model as $nodes){
            //查找节点设置
           $node_set = Times::find()->where('node_id = :node_id')->addParams([':node_id'=>$nodes->id])->all();
           foreach($node_set as $set){
               $set->delTimesRedis($nodes->id);
               $set->delete();
           }
           $nodes->delNodeRedis($nodes->com_id);
           $nodes->delete();
        }

        //查找所有的摄像头
        $camera_model = Camera::find()->where('com_id = :com_id',[':com_id'=>$id])->all();
        foreach($camera_model as $cameras){
            //查找摄像头设置
            $camera_set = CamSet::find()->where('cam_id = :cam_id')->addParams([':cam_id'=>$cameras->id])->all();
            foreach($camera_set as $sets){
                $sets->delRedis($cameras->id);
                $sets->delete();
            }
            $cameras->delCameraRedis($cameras->node_id);
            $cameras->delete();
        }

        //单位信息
        $this->findModel($id)->delCompanyRedis();
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('这请求页是不存在.');
        }
    }

    /**
     * Test Redis
     */
    public function actionTest(){
//        Yii::$app->redis->set('test','111123');     //设置redis缓存
        echo Yii::$app->cache->redis->get('cid64');         //获取redis缓存
//        Yii::$app->cache->set('rediscache','110112');
//        $model = new Company();
//        $model->getRedis();
//        echo 111;
        exit();
    }

    /**
     * 编辑单位
     */
    public function actionEdit($id){
        $company = Company::find()->where('id = :id',[':id'=>$id])->asArray()->one();
        $camera  = Camera::find()->where('com_id = :com_id',[':com_id'=>$id])->asArray()->All();
        $nodes   = Node::find()->where('com_id = :com_id',[':com_id'=>$id])->asArray()->All();
        return $this->render('edit',[
            'companys' => $company,
            'nodes'   => $nodes,
            'cameras'  => $camera
        ]);
    }

    public function actionRedis(){
        $model = new Company();
        $redis = $model->getRedis('70');
        var_dump($redis);
        die();
    }

    public function actionMailer(){
        $result = Yii::$app->mailer->compose()
            ->setFrom('1722318623@qq.com')
            ->setTo('756684177@qq.com')
            ->setSubject('Message subject')
            ->setTextBody('Plain text content')
            ->setHtmlBody('<b>HTML content</b>')
            ->send();
        $sms = Yii::$app->smser->send('13669361192','000000');
    }
}
