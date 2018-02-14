<?php

function todo_list(){
    $db = new PDO('sqlite:db/todo_db.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $items = $db->query('SELECT * FROM todos');
    return $items;
}

function todo_render(){
    $items = todo_list();
    require_once 'routes/lib_template.php';
    echo apply_template('template_todo_list', compact('items'));
}

function todo_remove($id){
    $db = new PDO('sqlite:db/todo_db.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db->prepare('DELETE FROM todos WHERE id=:id');
    $stmt->execute([':id'=>$id]);
}

function todo_add($item){
    $db = new PDO('sqlite:db/todo_db.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db->prepare('INSERT INTO todos (description) VALUES (:description)');
    $stmt->execute([':description'=>$item]);
}
