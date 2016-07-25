<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this); //注册资源包
//$this->registerCss("body { background: #f00; }");代码执行结果相当于在页面头部中添加了下面的代码 body { background: #f00; }
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!-- start: Header -->
<div class="navbar" role="navigation">

    <div class="container-fluid">

        <ul class="nav navbar-nav navbar-actions navbar-left">
            <li class="visible-md visible-lg"><a href="index.html#" id="main-menu-toggle"><i class="fa fa-th-large"></i></a></li>
            <li class="visible-xs visible-sm"><a href="index.html#" id="sidebar-menu"><i class="fa fa-navicon"></i></a></li>
        </ul>

        <form class="navbar-form navbar-left">
            <button type="submit" class="fa fa-search"></button>
            <input type="text" class="form-control" placeholder="Search..."></a>
        </form>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown visible-md visible-lg">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope-o"></i><span class="badge">5</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-menu-header">
                        <strong>Messages</strong>
                        <div class="progress thin">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                                <span class="sr-only">30% Complete (success)</span>
                            </div>
                        </div>
                    </li>
                    <li class="avatar">
                        <a href="page-inbox.html">
                            <img class="avatar" src="/statics/img/avatar1.jpg">
                            <div>New message</div>
                            <small>1 minute ago</small>
                            <span class="label label-info">NEW</span>
                        </a>
                    </li>
                    <li class="avatar">
                        <a href="page-inbox.html">
                            <img class="avatar" src="/statics/img/avatar2.jpg">
                            <div>New message</div>
                            <small>3 minute ago</small>
                            <span class="label label-info">NEW</span>
                        </a>
                    </li>
                    <li class="avatar">
                        <a href="page-inbox.html">
                            <img class="avatar" src="assets/img/avatar3.jpg">
                            <div>New message</div>
                            <small>4 minute ago</small>
                            <span class="label label-info">NEW</span>
                        </a>
                    </li>
                    <li class="avatar">
                        <a href="page-inbox.html">
                            <img class="avatar" src="assets/img/avatar4.jpg">
                            <div>New message</div>
                            <small>30 minute ago</small>
                        </a>
                    </li>
                    <li class="avatar">
                        <a href="page-inbox.html">
                            <img class="avatar" src="assets/img/avatar5.jpg">
                            <div>New message</div>
                            <small>1 hours ago</small>
                        </a>
                    </li>
                    <li class="dropdown-menu-footer text-center">
                        <a href="page-inbox.html">View all messages</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown visible-md visible-lg">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o"></i><span class="badge">3</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-menu-header">
                        <strong>Notifications</strong>
                        <div class="progress thin">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                                <span class="sr-only">30% Complete (success)</span>
                            </div>
                        </div>
                    </li>

                    <li class="clearfix">
                        <i class="fa fa-trash-o"></i>
                        <a href="page-activity.html" class="notification-user"> Lorenzo </a>
                        <span class="notification-action"> just remove <a href="#" class="notification-link"> 12 files</a></span>
                    </li>
                    <li class="dropdown-menu-footer text-center">
                        <a href="page-activity.html">View all notification</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown visible-md visible-lg">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gears"></i></a>
                <ul class="dropdown-menu update-menu" role="menu">
                    <li><a href="#"><i class="fa fa-database"></i> Database </a>
                    </li>
                    <li><a href="#"><i class="fa fa-bar-chart-o"></i> Connection </a>
                </ul>
            </li>
            <li class="dropdown visible-md visible-lg">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-method="post">        
<img class="user-avatar" src="<?=Url::to('@web/statics/img/avatar.jpg',true)?>" alt="user-mail">
                        <?=Yii::$app->user->identity->username?>
                </a>

                <ul class="dropdown-menu">
                    <li class="dropdown-menu-header">
                        <strong>312321</strong>
                    </li>
                    <li><a href="page-profile.html"><i class="fa fa-user"></i> Profile</a></li>
                    <li><a href="page-login.html"><i class="fa fa-wrench"></i> Settings</a></li>
                    <li><a href="page-invoice.html"><i class="fa fa-usd"></i> Payments <span class="label label-default">10</span></a></li>
                    <li><a href="gallery.html"><i class="fa fa-file"></i> File <span class="label label-primary">27</span></a></li>
                    <li class="divider"></li>
                    <li><a href="index.html"><i class="fa fa-sign-out"></i> Logout</a></li>
                </ul>
            </li>
            <li><a href="<?=Url::to(['site/logout'])?>" data-method="post" data-confirm="您确定要退出吗？"><i class="fa fa-power-off"></i></a></li>
        </ul>

    </div>

</div>
<!-- end: Header -->

<div class="container-fluid content">

    <div class="row">

        <!-- start: Main Menu -->
        <div class="sidebar ">

            <div class="sidebar-collapse">
                <div class="sidebar-header t-center">
                    <span><img class="text-logo" src="<?=Url::to('@web/statics/img/logo1.png')?>"><i class="fa fa-space-shuttle fa-3x blue"></i></span>
                </div>
                <div class="sidebar-menu">
                    <ul class="nav nav-sidebar">
                        <li><a href="<?=Url::to(['/site/index'])?>"><i class="fa fa-laptop"></i><span class="text"> 后台首页</span></a></li>
                        <li>
                            <a href="#"><i class="fa fa-file-text"></i><span class="text"> 后台管理</span> <span class="fa fa-angle-down pull-right"></span></a>
                            <ul class="nav sub">
                                <li><a href="<?=Url::to(['/company/index'])?>"><i class="fa fa-car"></i><span class="text"> 单位管理</span></a>

                                </li>
                                <li><a href="page-inbox.html"><i class="fa fa-envelope"></i><span class="text"> 摄像头管理</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-list-alt"></i><span class="text"> 模块管理</span> <span class="fa fa-angle-down pull-right"></span></a>
                            <ul class="nav sub">
                                <li><a href="<?=Url::to('@web/article/article/index')?>"><i class="fa fa-indent"></i><span class="text"> 文章模块</span></a></li>
                                <li><a href="form-wizard.html"><i class="fa fa-tags"></i><span class="text"> 流媒体管理</span></a></li>
                                <li><a href="form-dropzone.html"><i class="fa fa-plus-square-o"></i><span class="text"> 摄像头管理</span></a></li>
                                <li><a href="form-x-editable.html"><i class="fa fa-pencil"></i><span class="text"> X-视频管理</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-file-text"></i><span class="text"> 文件管理</span> <span class="fa fa-angle-down pull-right"></span></a>
                            <ul class="nav sub">
                                <li><a href="<?=Url::to(['/site/upload'])?>"><i class="fa fa-random"></i><span class="text"> 文件上传</span></a></li>
                                <li><a href="<?=Url::to(['/site/upload'])?>"><i class="fa fa-retweet"></i><span class="text"> 文件界定</span></a></li>
                                <li><a href="chart-other.html"><i class="fa fa-bar-chart-o"></i><span class="text"> 节点管理</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-signal"></i><span class="text"> PhpExcel</span> <span class="fa fa-angle-down pull-right"></span></a>
                            <ul class="nav sub">
                                <li><a href="<?=Url::to(['/php-excel/reader'])?>"><i class="fa fa-random"></i><span class="text"> 读取Excel</span></a></li>
                                <li><a href="<?=Url::to(['/php-excel/export'])?>"><i class="fa fa-retweet"></i><span class="text"> Mysql写入Excel</span></a></li>
                                <li><a href="chart-other.html"><i class="fa fa-bar-chart-o"></i><span class="text"> 节点管理</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-briefcase"></i><span class="text"> 扩展管理</span> <span class="fa fa-angle-down pull-right"></span></a>
                            <ul class="nav sub">
                                <li><a href="<?=Url::to(['/extends/carousel'])?>"><i class="fa fa-align-left"></i><span class="text"> 图片轮播组件</span></a></li>
                                <li><a href="<?=Url::to(['/extends/echarts'])?>"><i class="fa fa-outdent"></i><span class="text"> ECharts管理</span></a></li>
                                <li><a href="ui-elements.html"><i class="fa fa-list"></i><span class="text"></span></a></li>
                                <li><a href="ui-panels.html"><i class="fa fa-list-alt"></i><span class="text"> 用户管理</span></a></li>
                                <li><a href="ui-buttons.html"><i class="fa fa-th"></i><span class="text"> 用户管理</span></a></li>
                            </ul>
                        </li>
                        <li><a href="gallery.html"><i class="fa fa-picture-o"></i><span class="text"> 用户管理</span></a></li>
                        <li><a href="<?=Url::to(['site/logout'])?>" data-method="post" data-confirm="您确定要退出吗？"><i class="fa fa-calendar"></i><span class="text"> 安全退出</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="sidebar-footer">

                <div class="sidebar-brand">
                    Proton
                </div>

                <ul class="sidebar-terms">
                    <li><span style="cursor: pointer;" onclick="location.href='<?=Url::to(['site/language', 'lang' => 'zh-CN'])?>'">中文</span></li>
                    <li><a href="index.html#">Privacy</a></li>
                    <li><a href="index.html#">Help</a></li>
                    <li><a href="index.html#">About</a></li>
                </ul>

                <div class="copyright text-center">
                    <small>用户管理 <i class="fa fa-coffee"></i> from <a href="#" title="用户管理" target="_blank">用户管理</a></small>
                </div>
            </div>

        </div>
        <!-- end: Main Menu -->

        <!-- start: Content -->
        <div class="main">

            <div class="row">
                <div class="col-lg-12">
                    <!-- h3 class="page-header"><i class="fa fa-laptop"></i> 用户管理</h3-->
                    <?=Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs'])?$this->params['breadcrumbs']:[]
                    ])?>
                </div>
            </div>
            <?=$content?>
        </div>
        <!-- end: Content -->

    </div><!--/container-->


    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Warning Title</h4>
                </div>
                <div class="modal-body">
                    <p>Here settings can be configured...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="clearfix"></div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
