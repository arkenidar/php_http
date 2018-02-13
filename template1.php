<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?=$_('title')?></title>
</head>
<body>

<p><a href="/?u=multi&tab=1">multi-view</a></p>
<p><a href="/?u=api&id=10&message=some text">api test</a></p>

<p><?=$_('dump')?></p>
<p><?=$_('content')?></p>

<form action="/?u=mvc&id=44" method="post">
<input type="text" placeholder="type message here" name="message"></input>
<input type="submit" value="send"></input>
</form>

<p>This is a footer content.</p>
</body>
</html>
