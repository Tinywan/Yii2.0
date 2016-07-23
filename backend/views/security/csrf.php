<?php
header('Content-type:text/html;charset=utf-8');

?>
<form method="post">
    <input type="text" name="title" value="hello"/>
    <input type="hidden" name="_csrf" value="<?=$csrfToken?>"/>
    <input type="submit"  value="submit"/>
</form>
