<?php

$routes[''] = function($request_variables){
    serve_request(array_merge($request_variables,['r'=>'test1']));
};

require_once 'routes/routes_todo.php';

//require_once 'chat/routes_chat.php';
$routes['util/phpinfo'] = function($request_variables){
    phpinfo();
};

$routes['api'] = function($request_variables){
    require_once 'routes/api_test.php';
    http_api_test1($request_variables);
};
$routes['test1'] = function($request_variables){
    require_once 'routes/mvc_test.php';
    http_mvc_test1($request_variables);
};
$routes['multi'] = function($request_variables){
    require_once 'routes/mvc_multi.php';
    http_mvc_multi($request_variables);
};


