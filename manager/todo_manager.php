<?php

function todo_list(){
    require 'db/pdo.php';
    $items = $db->query('SELECT * FROM todos');
    return $items;
}

function todo_render(){
    $items = todo_list();
    require_once 'templates/lib_template.php';
    echo apply_template('todo/template_todo_list', compact('items'));
}

function todo_remove($id){
    require 'db/pdo.php';
    $stmt = $db->prepare('DELETE FROM todos WHERE id=:id');
    $stmt->execute([':id'=>$id]);
}

function todo_add($item){
    $item = trim($item);
    if($item=='') return;
    require 'db/pdo.php';
    $stmt = $db->prepare('INSERT INTO todos (description) VALUES (:description)');
    $stmt->execute([':description'=>$item]);
}

function todo_render_detail($id){
    require 'db/pdo.php';
    $stmt = $db->prepare('SELECT * FROM todos WHERE id=:id');
    $stmt->execute([':id'=>$id]);
    $item = $stmt->fetchAll()[0];

    require_once 'templates/lib_template.php';
    echo apply_template('todo/template_todo_detail', $item);
}

function todo_update($id, $description){
    require 'db/pdo.php';
    $stmt = $db->prepare('UPDATE todos SET description=:description WHERE id=:id');
    $stmt->execute([':id'=>$id, ':description'=>$description]);
}
