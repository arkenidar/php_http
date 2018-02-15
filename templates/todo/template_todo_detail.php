<?php
    $wrap = 'template_wrapper';
?>

<title>To Do (detail)</title>

<p>To Do Item detail</p>
<a href="?u=todo_remove&id=<?=$_('id')?>">Remove</a>

<form method="post" action="?u=todo_update">
<input name="description" placeholder="label of the todo item" value="<?=$_('description')?>">
<input type="hidden" name="id" value="<?=$_('id')?>">
<input type="submit" value="update">
</form>
