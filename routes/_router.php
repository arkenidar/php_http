<?php

$routes['default'] = 'test1';
$routes['404'] = function($request_variables){
    echo 'not found';
};
$routes['api'] = function($request_variables){
    require_once 'routes/api_test.php';
    echo http_api_test1($request_variables);
};
$routes['test1'] = function($request_variables){
    require_once 'routes/mvc_test.php';
    echo http_mvc_test1($request_variables);
};
$routes['multi'] = function($request_variables){
    require_once 'routes/mvc_multi.php';
    echo http_mvc_multi($request_variables);
};

///////////////

function todo_render(){
    $db = new PDO('sqlite:db/todo_db.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $items = $db->query('SELECT * FROM todos');
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

$routes['todo_list'] = function($request_variables){
    todo_render();
};
$routes['todo_add'] = function($request_variables){
    todo_add($request_variables['item']);
    todo_render();
};
$routes['todo_remove'] = function($request_variables){
    todo_remove($request_variables['id']);
    todo_render();
};
