<?php

namespace backend\controllers;

use Yii;
use backend\models\CamSet;
use backend\models\search\CamSetSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Camera;
use backend\models\Company;

/**
 * CamSetController implements the CRUD actions for CamSet model.
 */
class CamSetController extends Controller
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
     * Lists all CamSet models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CamSetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CamSet model.
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
     * Creates a new CamSet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//        $model = new CamSet();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('create', [
//                'model' => $model,
//            ]);
//        }
//    }

    /**
     * Updates an existing CamSet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($cam_id)
    {
        $model = CamSet::findOne(['cam_id'=>$cam_id]);
        $cam = Camera::findOne(['id'=>$cam_id]);
        $company = Company::find()->where(['id'=>$cam->com_id])->asArray()->one();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->setCamRedis();
            $cam->data = $model->ip; //配置成功摄像头参数，则把摄像头ip给摄像头信息data,状态为运行中
            $cam->status = "运行中";
            $cam->save();
            //$cam->setredis();
            return $this->redirect(['company/edit', 'id' => $cam->com_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'com_id' => $cam->com_id,
                'company'=>$company
            ]);
        }
    }

    /**
     * Deletes an existing CamSet model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$com_id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['company/edit','id'=>$com_id]);
    }

    /**
     * Finds the CamSet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CamSet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Camera::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the CamSet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CamSet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
}
