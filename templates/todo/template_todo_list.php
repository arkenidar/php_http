<?php
    $wrap = 'template_wrapper';
?>

<title>To Do</title>

<p>To Do Items</p>
<form method="post" action="?r=todo_add">
<input name="item" placeholder="label of the todo item" autofocus="true">
<input type="submit" value="add">
</form>
<?php foreach($_u('items') as $item) { ?>
    <li><a href="?r=todo_detail&id=<?=$_e($item['id'])?>"><?=$_e($item['description'])?></a></li>
<?php } ?>
