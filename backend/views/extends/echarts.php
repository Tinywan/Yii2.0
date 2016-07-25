<?php

/* @var $this yii\web\View */
use yii\web\JsExpression;
use daixianceng\echarts\ECharts;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$this->title = '视频管理主界面';
$this->params['breadcrumbs'][] = ['label'=>'站点信息','url'=>'site/index'];
$this->params['breadcrumbs'][] = $this->title;
?>
0000000000000
<?= ECharts::widget([
    'responsive' => true,
    'options' => [
        'style' => 'height: 400px;width: 400px;'
    ],
    'pluginEvents' => [
        'click' => [
            new JsExpression('function (params) {console.log(params)}'),
            new JsExpression('function (params) {console.log("ok")}')
        ],
        'legendselectchanged' => new JsExpression('function (params) {console.log(params.selected)}')
    ],
    'pluginOptions' => [
        'option' => [
            'title' => [
                'text' => '折线图堆叠'
            ],
            'tooltip' => [
                'trigger' => 'axis'
            ],
            'legend' => [
                'data' => ['邮件营销', '联盟广告', '视频广告', '直接访问', '搜索引擎']
            ],
            'grid' => [
                'left' => '3%',
                'right' => '4%',
                'bottom' => '3%',
                'containLabel' => true
            ],
            'toolbox' => [
                'feature' => [
                    'saveAsImage' => []
                ]
            ],
            'xAxis' => [
                'name' => '日期',
                'type' => 'category',
                'boundaryGap' => false,
                'data' => ['周一', '周二', '周三', '周四', '周五', '周六', '周日']
            ],
            'yAxis' => [
                'type' => 'value'
            ],
            'series' => [
                [
                    'name' => '邮件营销',
                    'type' => 'line',
                    'stack' => '总量',
                    'data' => [120, 132, 101, 134, 90, 230, 210]
                ],
                [
                    'name' => '联盟广告',
                    'type' => 'line',
                    'stack' => '总量',
                    'data' => [220, 182, 191, 234, 290, 330, 310]
                ],
                [
                    'name' => '视频广告',
                    'type' => 'line',
                    'stack' => '总量',
                    'data' => [150, 232, 201, 154, 190, 330, 410]
                ],
                [
                    'name' => '直接访问',
                    'type' => 'line',
                    'stack' => '总量',
                    'data' => [320, 332, 301, 334, 390, 330, 320]
                ],
                [
                    'name' => '搜索引擎',
                    'type' => 'line',
                    'stack' => '总量',
                    'data' => [820, 932, 901, 934, 1290, 1330, 1320]
                ]
            ]
        ]
    ]
]);
?>

<hr/>111
<?php
Modal::begin([
    'id' => 'page-modal',
    'header' => "<h5>这里是标题</h5>",
    'toggleButton' => ['label' => 'click me'],
]);

echo '这里是模态内容...';

Modal::end();
?>

<?= Html::a('点击按钮', '#', [
    'class' => 'btn btn-success',
    'data-toggle' => 'modal',
    'data-target' => '#page-modal'    //此处对应Modal组件中设置的id
])
?>

