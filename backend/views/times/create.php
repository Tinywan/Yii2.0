<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Times */

$this->title = Yii::t('common','Create Times');
$this->params['breadcrumbs'][] = ['label'=>Yii::t('common','Company Manage'),'url'=>'/company/index'];
$this->params['breadcrumbs'][] = ['label'=>Yii::t('common','Company Set'),'url'=>['/company/edit','id'=>$com_id]];
$this->params['breadcrumbs'][] = ['label'=>Yii::t('common','Times Manage'),'url'=>['/times/set','node_id'=>$node_id]];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<div class="times-create">

    <?= $this->render('_form', [
        'model' => $model,
        ''
    ]) ?>

</div>
