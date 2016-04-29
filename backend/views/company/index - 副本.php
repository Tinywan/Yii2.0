<?php

use yii\helpers\Html;
use backend\models\LinkPages;
use yii\widgets;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common','Company List');
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="content" class="white">
    <h1>
    </h1>
    <div class="bloc">
        <div class="title">
            单位信息
        </div>
        <div class="content">
            <table>
                <thead>
                <tr>
                    <th><input type="checkbox" class="checkall"/></th>
                    <th>ID</th>
                    <th>单位名称</th>
                    <th>地址</th>
                    <th>联系电话</th>
                    <th>节点数</th>
                    <th>摄像头数</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    foreach($data['data'] as $company):
                ?>

                    <tr>
                        <td><?=Html::encode($company['id'])?></td>
                        <td><?=Html::encode($company['id'])?></td>
                        <td><?=Html::encode($company['name'])?></td>
                        <td><?=Html::encode($company['adress'])?></td>
                        <td><?=Html::encode($company['phone'])?></td>
                        <td><?=Html::encode($company['node_count'])?></td>
                        <td><?=Html::encode($company['cma_count'])?></td>
                        <td>
                            <a href="<?=Yii::$app->urlManager->createUrl(['company/dao','id'=>$company['id']]);?>" class="handle-btn edit-btn">编辑</a>
                            <a href="<?=Yii::$app->urlManager->createUrl(['company/delete','id'=>$company['id']]);?>" class="handle-btn del-btn">删除</a>
                        </td>
                    </tr>
                <?php
                    endforeach;
                ?>
                </volist>
                </tbody>
            </table>
            <div style="clear: both;">
                <?=LinkPages:: widget([
                    'pagination' => $pages,
                    'maxButtonCount' => 6,  //显示分页数量,默认的就是10个哦
                    'firstPageLabel' => '首页',
                    'nextPageLabel' => '下一页',
                    'prevPageLabel' => '上一页',
                    'lastPageLabel' => '尾页',
                ]);?>
            </div>

        </div>
    </div>
</div>
