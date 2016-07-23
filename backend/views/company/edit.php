<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\AppAsset;


/* @var $this yii\web\View */
/* @var $model app\models\Company */

$this->title = Yii::t('common','Company Set');
$this->params['breadcrumbs'][] = ['label'=>Yii::t('common','Company Manage'),'url'=>'index'];
$this->params['breadcrumbs'][] = ['label'=>$this->title];

AppAsset::register($this);
$this->registerCssFile('@web/statics/css/add-ons.min.css',['depends'=>['backend\assets\AppAsset']]);
?>
<div class="row">

    <div class="col-lg-3 col-sm-6 col-xs-6 col-xxs-12">
        <div class="smallstat blue-bg">
            <i class="fa fa-bell white-bg"></i>
            <a class="btn btn-success btn-lg" href="<?=Url::to(['node/create','id'=>$companys['id']])?>">新增节点</a>
        </div><!--/.smallstat-->
    </div><!--/.col-->

    <div class="col-lg-3 col-sm-6 col-xs-6 col-xxs-12">
        <div class="smallstat magenta-bg">
            <i class="fa fa-cogs white-bg"></i>
            <span class="value black"><h2>名称</h2></span>
            <span class="title"><h5><?=Html::encode($companys['name'])?></h5></span>
        </div><!--/.smallstat-->
    </div><!--/.col-->

    <div class="col-lg-3 col-sm-6 col-xs-6 col-xxs-12">
        <div class="smallstat blue-bg">
            <i class="fa fa-laptop white-bg"></i>
            <span class="value black"><h2>电话</h2></span>
            <span class="title"><h5><?=Html::encode($companys['phone'])?></h5></span>
        </div><!--/.smallstat-->
    </div><!--/.col-->

    <div class="col-lg-3 col-sm-6 col-xs-6 col-xxs-12">
        <div class="smallstat green-bg">
            <i class="fa fa-moon-o white-bg"></i>
            <span class="value black"><h2>地址</h2></span>
            <span class="title"><h5><?=Html::encode($companys['adress'])?></h5></span>
        </div><!--/.smallstat-->
    </div><!--/.col-->

</div>
<!-----------The Seconds---------------->
<div class="row">




    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><i class="fa fa-table red"></i><span class="break"></span><strong>节点管理</strong></h2>
                <div class="panel-actions">
                    <a href="table.html#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                    <a href="table.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="table.html#" class="btn-close"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#ID</th>
                        <th>单位信息</th>
                        <th>摄像头个数</th>
                        <th>信息</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($nodes as $node):
                        ?>
                        <tr>
                            <td><?=Html::encode($node['id'])?></td>
                            <td><?=Html::encode($node['com_id'])?></td>
                            <td><?=Html::encode($node['cam_num'])?></td>
                            <td>
                                <?php
                                if ($node['data']=='')
                                    echo "空";
                                else echo Html::encode($node['data']);
                                ?>
                            </td>
                            <td>
                                <a class="btn btn-success btn-sm"
                                   href="<?=Url::to(
                                       ['camera/create', 'com_id'=>$companys['id'], 'node_id'=>$node['id']]
                                   )?>"
                                   data-method="post"
                                   data-confirm="您确定要新增摄像头？">添加摄像头
                                </a>

                                <a class="btn btn-primary btn-sm" href="<?=Url::to(['times/set','node_id'=>$node['id']])?>" data-method="post">时间段设置</a>
                                <a class="btn btn-danger btn-sm" href="<?=Url::to(['node/delete','id'=>$node['id']])?>" data-method="post" data-confirm="您确定要删除摄像头？">删除节点</a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div><!--/col-->
<!---------------Node -------------------->
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><i class="fa fa-life-bouy red"></i><strong>摄像头管理</strong></h2>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#ID</th>
                        <th>所属节点</th>
                        <th>状态</th>
                        <th>信息</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($cameras as $cam):
                        ?>
                        <tr>
                            <td><?=Html::encode($cam['id'])?></td>
                            <td><?=Html::encode($cam['node_id'])?></td>
                            <td>
                                <?php
                                if($cam['status'] == '空闲'){
                                    ?><span class="label label-success">空闲</span><?php
                                }else{
                                    ?><span class="label label-danger"><?=Html::encode($cam['status'])?></span><?php
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($cam['data']=='')
                                    echo "空";
                                else echo Html::encode($cam['data']);
                                ?>
                            </td>
                            <td width="120">
                                <a class="btn btn-primary btn-sm" href="<?=Url::to(['cam-set/update','cam_id'=>$cam['id']])?>" data-method="post">设置</a>
                                <a class="btn btn-danger btn-sm" href="<?=Url::to(['camera/delete','id'=>$cam['id']])?>" data-method="post" data-confirm="您确定要删除摄像头？">删除</a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div><!--/.col-->


</div>
<script>
    console.table(array('1','4','6'));
</script>
