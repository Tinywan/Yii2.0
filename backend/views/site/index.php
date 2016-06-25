<?php

/* @var $this yii\web\View */

$this->title = '视频管理主界面';
$this->params['breadcrumbs'][] = ['label'=>'站点信息','url'=>'site/index'];
$this->params['breadcrumbs'][] = $this->title;
?>
欢迎:<?=Yii::$app->user->identity->username?><br/>
是否是游客:<?=Yii::$app->user->identity->username?>
<?php
var_dump(Yii::$app->user->identity->toArray());
?>
