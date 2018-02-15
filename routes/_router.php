<?php

$routes['default'] = 'todo_list';
$routes['404'] = function($request_variables){
    echo 'not found';
};

require_once 'routes/routes_todo.php';

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


