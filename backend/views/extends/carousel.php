<?php

/* @var $this yii\web\View */
use yii\bootstrap\Carousel;
use yii\bootstrap\Tabs;
$this->title = '视频管理主界面';
$this->params['breadcrumbs'][] = ['label'=>'站点信息','url'=>'site/index'];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo Carousel::widget([
    'items' => [
      /*  // 只有图片的格式
        '<img src="http://www.yii-china.com/themes/yiicn/images/banner/b2.jpg"/>',

        // 与上面的效果一致
        ['content' => '<img src="http://www.yii-china.com/themes/yiicn/images/banner/b3.jpg"/>'],*/

        // 包含图片和字幕的格式
        [
            'content' => '<img src="http://www.yii-china.com/themes/yiicn/images/banner/b1.jpg"/>',
            'caption' => '<h4>快速</h4><p>Yii 只加载您需要的功能</p>',
            //'options' => [...],       //配置对应的样式
        ],

        // 包含图片和字幕的格式
        [
            'content' => '<img src="http://www.yii-china.com/themes/yiicn/images/banner/b2.jpg"/>',
            'caption' => '<h4>安全</h4><p>Yii 的标准是安全的</p>',
            //'options' => [...],       //配置对应的样式
        ],

        // 包含图片和字幕的格式
        [
            'content' => '<img src="http://www.yii-china.com/themes/yiicn/images/banner/b3.jpg"/>',
            'caption' => '<h4>专业</h4><p>Yii 可帮助您开发清洁和可重用的代码</p>',
            //'options' => [...],       //配置对应的样式
        ],
    ]
]);
?>

<?php
/**
 * yii2-bootstrap扩展之tab切换
 */
echo Tabs::widget([
    'items' => [
        [
            'label' => 'One',
            'content' => 'Anim pariatur cliche...',
            'active' => true
        ],
        [
            'label' => 'Two',
            'content' => 'Anim pariatur cliche...',
            'headerOptions' => ['....'],
             'options' => ['id' => 'myveryownID'],
      ],
      [
          'label' =>'Example',
          'url' => 'http://www.example.com',
      ],
      [
          'label' => 'Dropdown',
          'items' => [
              [
                  'label' => 'DropdownA',
                  'content' => 'DropdownA, Anim pariatur cliche...',
              ],
              [
                  'label' => 'DropdownB',
                  'content' => 'DropdownB, Anim pariatur cliche...',
              ],
          ],
      ],
  ],
]);
?>
