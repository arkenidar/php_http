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

// todo

$routes['todo_list'] = function($request_variables){
    require_once 'manager/todo_manager.php';
    todo_render();
};
$routes['todo_add'] = function($request_variables){
    require_once 'manager/todo_manager.php';
    todo_add($request_variables['item']);
    header("Location: ?u=todo_list");
};
$routes['todo_remove'] = function($request_variables){
    require_once 'manager/todo_manager.php';
    todo_remove($request_variables['id']);
    header("Location: ?u=todo_list");
};
$routes['todo_detail'] = function($request_variables){
    require_once 'manager/todo_manager.php';
    $id = (int)@$request_variables['id'];
    todo_render_detail($id);
};
$routes['todo_update'] = function($request_variables){
    require_once 'manager/todo_manager.php';
    $id = (int)@$request_variables['id'];
    $description = (string)@$request_variables['description'];
    todo_update($id, $description);
    header("Location: ?u=todo_list");
};
