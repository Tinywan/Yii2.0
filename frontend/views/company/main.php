<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/9
 * Time: 10:27
 */
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">
    <table width="600" height="200">
        <tr>
            <td colspan="4"><h1>单位信息</h1></td>
        </tr>

        <tr>
            <td>#ID</td>
            <td>名称</td>
            <td>地址</td>
            <td>电话</td>
            <td>编辑</td>
        </tr>
        <tr>
            <td><?=Html::encode($company['id'])?></td>
            <td><?=Html::encode($company['name'])?></td>
            <td><?=Html::encode($company['adress'])?></td>
            <td><?=Html::encode($company['phone'])?></td>
            <td>
                <a class="btn btn-success" href="<?=Url::to(['@backend/node/delete','id'=>$company['id']])?>" data-method="post">编辑</a>
            </td>
        </tr>
    </table>

</div>
