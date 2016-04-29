<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\CamSetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cam-set-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cam_id') ?>

    <?= $form->field($model, 'ip') ?>

    <?= $form->field($model, 'pixels') ?>

    <?= $form->field($model, 'code_rate') ?>

    <?php // echo $form->field($model, 'frame_rate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
