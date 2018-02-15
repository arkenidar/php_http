<?php
$db = new PDO('sqlite:db/todo_db.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
