<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?=$_('title')?></title>
</head>
<body>
<p><?=$_('dump')?></p>
<p><?=$_('content')?></p>

<a href="/?u=api&id=10&message=some text">api test</a>

<form action="/?u=mvc&id=44" method="post">
<input type="text" placeholder="type message here" name="message"></input>
<input type="submit" value="send"></input>
</form>

<p>footer.</p>
</body>
</html>
