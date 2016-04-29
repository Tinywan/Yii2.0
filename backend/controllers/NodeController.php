<?php

namespace backend\controllers;

use backend\models\CamSet;
use backend\models\Camera;
use backend\models\Times;
use Yii;
use backend\models\Node;
use backend\models\Company;
use backend\models\search\NodeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NodeController implements the CRUD actions for Node model.
 */
class NodeController extends Controller
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
     * Lists all Node models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NodeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Node model.
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
     * Creates a new Node model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Node();
        $model->com_id = $id;
        $model->save();
        $model->setNodeRedis();

        $com = Company::findOne($id);
        $com->node_count++;
        $com->save();
        $com->setCompanyRedis();
        return $this->redirect(['company/edit', 'id' => $id]);
    }

    /**
     * Updates an existing Node model.
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
     * Deletes an existing Node model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        $node_model = $this->findModel($id);

        $com_model = Company::findOne(['id'=>$node_model->com_id]);
        $com_model->node_count--;
        $com_model->save();
        $com_model->setCompanyRedis();

        $tim_model = Times::findAll(['node_id'=>$id]);//查找节点的所有设置时间段
        foreach($tim_model as $time){
            $time->delTimesRedis($id);
            $time->delete();
        }

        $cam_model = Camera::findAll(['node_id'=>$id]);//查找节点的所有设置时间段
        foreach($cam_model as $cam){
            $cam->delCameraRedis($id);
            $cam->delete();

            $cam_set = CamSet::findOne(['cam_id'=>$cam->id]);
            $cam_set->delRedis($cam->id);
            $cam_set->delete();
        }

        $node_model->delNodeRedis($node_model->com_id);
        $this->findModel($id)->delete();

        return $this->redirect(['company/edit','id'=>$node_model->com_id]);
    }

    /**
     * Finds the Node model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Node the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Node::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
