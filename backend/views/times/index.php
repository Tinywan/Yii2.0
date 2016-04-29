<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\TimesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common','Times Manage');
$this->params['breadcrumbs'][] = ['label'=>Yii::t('common','Company Manage'),'url'=>'/company/index'];
$this->params['breadcrumbs'][] = ['label'=>Yii::t('common','Company Set'),'url'=>['/company/edit','id'=>$com_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- DATA TABLES -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><i class="fa fa-table red"></i><span class="break"></span><strong>节点时间设置列表</strong></h2>
                <div class="panel-actions">
                    <a href="table.html#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                    <a href="table.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="table.html#" class="btn-close"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>序号</th>
                        <th>#ID</th>
                        <th>节点信息</th>
                        <th>开始时间</th>
                        <th>结束时间</th>
                        <th>
                            <a class="btn btn-primary btn-sm"
                               href="<?=Url::to(['times/create','node_id'=>$node_id])?>" data-method="post">新增时间段</a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($times as $time):
                        ?>
                        <tr>
                            <td><?=Html::encode($i); ?></td>
                            <td><?=Html::encode($time['id']); ?></td>
                            <td><?=Html::encode($time['node_id']); ?></td>
                            <td><?=Html::encode($time['star_time']); ?></td>
                            <td><?=Html::encode($time['end_time']); ?></td>
                            <td>
                                <a class="btn btn-primary btn-sm"
                                   href="<?=Url::to(['times/update','id'=>$time['id']])?>" data-method="post">编辑</a>
                                <a class="btn btn-danger btn-sm"
                                   href="<?=Url::to(['times/delete','id'=>$time['id']])?>" data-method="post" data-confirm="您确定要删除此项吗？">删除</a>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    endforeach;
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div><!--/col-->
</div><!--/row-->

