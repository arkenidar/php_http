<?php
    $wrap = 'template_wrapper';
?>

<title>To Do</title>

<p>To Do Items</p>
<form method="post" action="?u=todo_add">
<input name="item" placeholder="label of the todo item">
<input type="submit" value="add">
</form>
<?php foreach($_('items') as $item) { ?>
    <li><a href="?u=todo_remove&id=<?=$item['id']?>"><?=$item['description']?></a></li>
<?php } ?>
