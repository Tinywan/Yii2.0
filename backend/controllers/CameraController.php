<?php

namespace backend\controllers;

use Yii;
use backend\models\Camera;
use backend\models\CamSet;
use backend\models\Company;
use backend\models\search\CameraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Node;

/**
 * CameraController implements the CRUD actions for Camera model.
 */
class CameraController extends Controller
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
     * Lists all Camera models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CameraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Camera model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Camera model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($com_id,$node_id)
    {
        //添加摄像头信息Camera
        $model = new Camera();
        $model->com_id = $com_id;
        $model->node_id = $node_id;
        $model->status = '空闲';
        $model->save();
        $model->setCameraRedis();

        //节点++
        $node = Node::findOne(['id'=>$node_id]);
        $node->cam_num++;
        $node->save();
        $node->setNodeRedis();

        //Cam_Set摄像头设置对应的cam_id
        $node = new CamSet();
        $node->cam_id = $model->id; //在控制器中可以$model->id 获取当前的插入的“id”值
        $node->save();

        //设置摄像头次数自增加一
        $com = Company::findOne($com_id);
        $com->cma_count++;
        $com->save();
        $com->setCompanyRedis();

        return $this->redirect(['company/edit', 'id' => $com_id]);
    }

    /**
     * Updates an existing Camera model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($cam_id)
    {
        $model = new CamSet();
        $camera = Camera::findOne(['id'=>$cam_id]);

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            $camera->data = $model->ip;
            $camera->status = '运行中';
            $camera->save();
            $camera->setCameraRedis();
            return $this->redirect(['company/index', 'cam_id' => $model->cam_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Camera model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $com_id = $this->findModel($id)->com_id;
        $camset = CamSet::findOne(['cam_id' =>$id]);
        $node_id = $this->findModel($id)->node_id;
        $camset->delRedis($id);
        $camset->delete();

        $camera = Node::findOne(['id'=>$node_id]);
        $camera->cam_num--;
        $camera->save();
        $camera->setNodeRedis();

        $com = Company::findOne($com_id);
        $com->cma_count--;
        $com->save();
        $com->setCompanyRedis();
        $this->findModel($id)->delCameraRedis($node_id);
        $this->findModel($id)->delete();

        return $this->redirect(['company/edit','id'=>$com_id]);
    }

    /**
     * Finds the Camera model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Camera the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Camera::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('请求的页面不存在.');
        }
    }

    /**
     * Finds the Camera model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Camera the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionGetRedis(){
        $model = new Camera();
        $node_id = 57;
        $camera_id = 131;
        $result = $model->getCameraRedis($node_id,$camera_id);
        var_dump($result);
        exit();
    }
}
