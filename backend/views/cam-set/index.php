<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CamSetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common','Times Manage');
$this->params['breadcrumbs'][] = ['label'=>Yii::t('common','Company Manage'),'url'=>'/company/index'];
$this->params['breadcrumbs'][] = ['label'=>Yii::t('common','Company Set'),'url'=>['/company/edit','id'=>$com_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cam-set-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cam Set', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cam_id',
            'ip',
            'pixels',
            'code_rate',
            // 'frame_rate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
