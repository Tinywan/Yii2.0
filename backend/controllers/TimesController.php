<?php

namespace backend\controllers;

use Yii;
use backend\models\Times;
use backend\models\Node;
use backend\models\search\TimesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TimesController implements the CRUD actions for Times model.
 */
class TimesController extends Controller
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
     * Lists all Times models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TimesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Times model.
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
     * Creates a new Times model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($node_id)
    {
        $model = new Times();
        $com_id = Node::findOne(['id'=>$node_id])->com_id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->node_id = $node_id;
            $model->save();
            $model->setTimesRedis();
            return $this->redirect(['times/set','node_id'=>$node_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'com_id' => $com_id,
                'node_id' => $node_id
            ]);
        }
    }

    /**
     * Updates an existing Times model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $com_id = Node::findOne(['id'=>$model->node_id])->com_id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->setTimesRedis();
            return $this->redirect(['set', 'node_id' => $model->node_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'com_id' => $com_id,
                'node_id' => $model->node_id
            ]);
        }
    }

    /**
     * Deletes an existing Times model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Times model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Times the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Times::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * 节点时间段设置
     */
    public function actionSet($node_id){
        $model = Times::find()->where('node_id = :node_id',[':node_id'=>$node_id])->asArray()->all();
        $n_model = Node::findOne(['id'=>$node_id]);
        return $this->render('index',[
            'node_id' =>$node_id,
            'com_id'      =>$n_model->com_id,
            'times'   =>$model,
        ]);
    }
}
