<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Times */

$this->title = Yii::t('common','Update Times');
$this->params['breadcrumbs'][] = ['label'=>Yii::t('common','Company Manage'),'url'=>'/company/index'];
$this->params['breadcrumbs'][] = ['label'=>Yii::t('common','Company Set'),'url'=>['/company/edit','id'=>$com_id]];
$this->params['breadcrumbs'][] = ['label'=>Yii::t('common','Times Manage'),'url'=>['/times/set','node_id'=>$node_id]];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<div class="times-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
