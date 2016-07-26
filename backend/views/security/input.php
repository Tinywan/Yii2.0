<?php
// 单独引入一个js或者css文件
$this->registerCssFile('@web/statics/css/input.css',['depends'=>['backend\assets\AppAsset']]);
$this->registerJsFile('@web/statics/js/input.js',['depends'=>['backend\assets\AppAsset'],'media' => 'print'], 'css-print-theme');
$this->registerCss("body { background: #f00; }");
?>
<form action="" method="POST">
    name: <input type="text" name="name" value="tom" id="name" /><br />
    age:<input type="text" name="age" value="22" /><br />
    <input type="hidden" name="_csrf" value="<?=$csrfToken?>"/>
    <input type="submit" value="Submit" />
</form>
