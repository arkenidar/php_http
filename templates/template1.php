<?php
    $wrap = 'template_wrapper';
?>

<title>MVC test 1</title>

<p><?=$_('dump')?></p>
<p><?=$_('content')?></p>

<form action="?u=test1&id=44" method="post">
<input type="text" placeholder="type message here" name="message"></input>
<input type="submit" value="send"></input>
</form>
