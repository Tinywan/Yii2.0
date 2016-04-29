<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CamSet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cam-set-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--?= $form->field($model, 'cam_id')->textInput() ?-->

    <?= $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pixels')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code_rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'frame_rate')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '确认' : '确认', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
