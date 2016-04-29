<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
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

    <div class="row">
        <div id="content" class="col-sm-12 full">
            <div class="row">
                <div class="login-box">

                    <div class="header">
                        Yii管理后台登录
                    </div>
                    <div class="text-center">
                        <li><a href="" class="fa fa-facebook facebook-bg"></a></li>
                        <li><a href="" class="fa fa-twitter twitter-bg"></a></li>
                        <li><a href="" class="fa fa-linkedin linkedin-bg"></a></li>
                    </div>

                    <div class="text-with-hr">
                        <hr/>
                    </div>

                    <form class="form-horizontal login" action="index.html" method="post">

                        <fieldset class="col-sm-12">
                            <div class="form-group">
                                <div class="controls row">
                                    <div class="input-group col-sm-12">
                                        <input type="text" class="form-control" id="username" placeholder="Username or E-mail"/>
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    </div>
                                    <?= $form->field($model, 'username',[
                                        'inputOptions' => ['class'=>'form-control'],
                                        'inputTemplate' => '<span class="input-group-addon"><i class="fa fa-user"></i>{input}</span>',
                                    ])->label(false) ?>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="controls row">
                                    <div class="input-group col-sm-12">
                                        <input type="password" class="form-control" id="password" placeholder="Password"/>
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="confirm">
                                <input type="checkbox" name="remember"/>
                                <label for="remember">Remember me</label>
                            </div>

                            <div class="row">

                                <button type="submit" class="btn btn-lg btn-primary col-xs-12">Login</button>

                            </div>

                        </fieldset>

                    </form>

                    <a class="pull-left" href="page-login.html#">Forgot Password?</a>
                    <a class="pull-right" href="page-register.html">Sign Up!</a>

                    <div class="clearfix"></div>

                </div>
            </div><!--/row-->

        </div>

    </div><!--/row-->
<?php ActiveForm::end(); ?>