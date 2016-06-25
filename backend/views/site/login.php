<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
$this->title = '登录';
?>

<?php
$form = ActiveForm::begin([
    'id' => 'login-form',
    'options'=>[
        'class'=>'form-vertical login-form'
    ]
]);
?>

    <div class="login-content" style="text-align: center; padding-top: 10px;">
        <h3 class="form-title">Yii管理系统</h3>
        <div class="alert alert-error hide">
            <button class="close" data-dismiss="alert"></button>
            <span>这里填写错误信息</span>
        </div>

        <div class="control-group">
            <?= $form->field($model, 'username',[
                'inputOptions' => ['class'=>'m-wrap placeholder-no-fix'],
                'inputTemplate' => '<div class="input-icon left"><i class="icon-user"></i>{input}</div>',
            ])->label(false) ?>
        </div>

        <div class="control-group">
            <?= $form->field($model, 'password',[
                'inputOptions' => ['class'=>'m-wrap placeholder-no-fix'],
                'inputTemplate' => '<div class="input-icon left"><i class="icon-lock"></i>{input}</div>',
            ])->passwordInput()->label(false) ?>
        </div>

        <div class="actions" style="padding-bottom: 70px;border-bottom:1px solid #eee;">
            <?= $form->field($model, 'rememberMe',[
                'inputTemplate'=>'{input}<button type="submit" class="btn btn-primary green pull-right" name="login-button">登录</button>'
            ])->checkbox() ?>
        </div>


    </div>
<?php ActiveForm::end(); ?>