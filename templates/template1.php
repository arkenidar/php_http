<?php
    $wrap = 'template_wrapper';
?>

<title>MVC test 1</title>

<p><?=$_('dump')?></p>
<p><?=$_('content')?></p>

<form action="test1?id=44" method="post">
<input type="text" placeholder="type message here" name="message" autofocus="true"></input>
<input type="submit" value="send"></input>
</form>

<a href="test1?id=10&message=some text">TEST: test1?id=10&message=some text</a>
