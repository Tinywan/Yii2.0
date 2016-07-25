<?php
header('Content-type:text/html;charset=utf-8');

?>
<form action="" method="POST">
    name: <input type="text" name="name" value="tom" /><br />
    age:<input type="text" name="age" value="22" /><br />
    <input type="hidden" name="_csrf" value="<?=$csrfToken?>"/>
    <input type="submit" value="Submit" />
</form>
