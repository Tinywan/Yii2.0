<?php
$this->registerCssFile('@web/statics/css/input.css',['depends'=>['backend\assets\AppAsset']]);
?>
<form action="" method="POST">
    name: <input type="text" name="name" value="tom" id="name" /><br />
    age:<input type="text" name="age" value="22" /><br />
    <input type="hidden" name="_csrf" value="<?=$csrfToken?>"/>
    <input type="submit" value="Submit" />
</form>
