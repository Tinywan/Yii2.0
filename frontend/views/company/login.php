<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="login-panel">
    <!--登录表单-->
    <div class="login-form">
        <div class="camera-icon"></div>
        <?php $form = ActiveForm::begin([

            'fieldConfig' => [
                'template' => "{label}\n<div class=\"form-item\">{input}<span class=\"tip-icon icon-error\"></span><p>{error}</p></div>",
                'labelOptions' => ['class' => 'lab-title'],
                'inputOptions' =>['class' => 'form-text']
            ],
        ]); ?>

        <ul class="form-list">
            <li>
                <?= $form->field($model, 'id')->textInput()->hint('请输入单位id')->label('单位ID') ?>
            </li>
            <li>
                <?= $form->field($model, 'redis_host')->textInput()->hint('请输入redis服务器')->label('Redis服务器') ?>
            </li>


        </ul>
        <div class="form-handle">
            <?= Html::submitButton('确认', ['class' => 'form-btn']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="form-bottom">
        XXXXXXXXXXXXXX
    </div>
</div>
