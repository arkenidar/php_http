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
    echo apply_template('todo/template_todo_list', compact('items'));
}

function todo_remove($id){
    $db = new PDO('sqlite:db/todo_db.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db->prepare('DELETE FROM todos WHERE id=:id');
    $stmt->execute([':id'=>$id]);
}

function todo_add($item){
    $item = trim($item);
    if($item=='') return;
    $db = new PDO('sqlite:db/todo_db.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db->prepare('INSERT INTO todos (description) VALUES (:description)');
    $stmt->execute([':description'=>$item]);
}

function todo_render_detail($id){
    $db = new PDO('sqlite:db/todo_db.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db->prepare('SELECT * FROM todos WHERE id=:id');
    $stmt->execute([':id'=>$id]);
    $item = $stmt->fetchAll()[0];

    require_once 'routes/lib_template.php';
    echo apply_template('todo/template_todo_detail', $item);
}

function todo_update($id, $description){
    $db = new PDO('sqlite:db/todo_db.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db->prepare('UPDATE todos SET description=:description WHERE id=:id');
    $stmt->execute([':id'=>$id, ':description'=>$description]);
}
