<?php

$routes['todo_list'] = function($request_variables){
    require_once 'manager/todo_manager.php';
    todo_render();
};

$routes['todo_add'] = function($request_variables){
    require_once 'manager/todo_manager.php';
    todo_add($request_variables['item']);
    header("Location: ?r=todo_list");
};

$routes['todo_remove'] = function($request_variables){
    require_once 'manager/todo_manager.php';
    todo_remove($request_variables['id']);
    header("Location: ?r=todo_list");
};

$routes['todo_detail'] = function($request_variables){
    require_once 'manager/todo_manager.php';
    if(!isset($request_variables['id'])) return;
    $id = (int)$request_variables['id'];
    todo_render_detail($id);
};

$routes['todo_update'] = function($request_variables){
    require_once 'manager/todo_manager.php';
    if(!isset($request_variables['id'])) return;
    if(!isset($request_variables['description'])) return;
    $id = (int)$request_variables['id'];
    $description = (string)$request_variables['description'];
    todo_update($id, $description);
    header("Location: ?r=todo_list");
};
