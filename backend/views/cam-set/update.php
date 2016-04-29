<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CamSet */

$this->title = Yii::t('common','Camera Set');
$this->params['breadcrumbs'][] = ['label'=>Yii::t('common','Company Manage'),'url'=>'/company/index'];
$this->params['breadcrumbs'][] = ['label'=>Yii::t('common','Company Set'),'url'=>['/company/edit','id'=>$com_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cam-set-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
