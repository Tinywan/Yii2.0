<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\LinkPages;
use yii\widgets;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common','Company List');
$this->params['breadcrumbs'][] = ['label'=>Yii::t('common','Company Manage'),'url'=>'index'];
$this->params['breadcrumbs'][] = ['label'=>$this->title];
?>

<!-- DATA TABLES -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><i class="fa fa-table red"></i><span class="break"></span><strong>单位信息列表</strong></h2>
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
                        <th>单位名称</th>
                        <th>地址</th>
                        <th>联系电话</th>
                        <th>节点数</th>
                        <th>摄像头数</th>
                        <th>
                          <?=Html::a("新增单位 <i class='icon-plus'></i>" , ['company/create' ], ['class' => 'btn btn-success btn-sm']) ?>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($data['data'] as $company):
                        ?>
                        <tr>
                            <td><?=Html::encode($i); ?></td>
                            <td><?=Html::encode($company['id']); ?></td>
                            <td><?=Html::encode($company['name']); ?></td>
                            <td><?=Html::encode($company['adress']); ?></td>
                            <td><?=Html::encode($company['phone']); ?></td>
                            <td><?=Html::encode($company['node_count']); ?></td>
                            <td><?=Html::encode($company['cma_count']); ?></td>
                            <td>
                                <a class="btn btn-primary btn-sm" 
                                href="<?=Url::to(['company/edit','id'=>$company['id']])?>" data-method="post">编辑</a>
                                <a class="btn btn-danger btn-sm" 
                                href="<?=Url::to(['company/delete','id'=>$company['id']])?>" data-method="post" data-confirm="您确定要删除此项吗？">删除</a>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    endforeach;
                    ?>

                    </tbody>
                </table>
                <?=LinkPages:: widget([
                    'pagination' => $pages,
                    'maxButtonCount' => 6,  //显示分页数量,默认的就是10个哦
                    'firstPageLabel' => '首页',
                    'nextPageLabel' => '下一页',
                    'prevPageLabel' => '上一页',
                    'lastPageLabel' => '尾页',
                    //如果你的数据过少，不够2页，默认不显示分页，如果你需要，设置
                    'hideOnSinglePage' => false,
                    //'options' => ['class' => 'm-pagination'], //自己写的样式
                ]);?>
            </div>
        </div>
    </div><!--/col-->
</div><!--/row-->