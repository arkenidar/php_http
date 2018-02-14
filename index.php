<?php

$request_variables = $_REQUEST;
serve_request($request_variables);

function serve_request($request_variables){

    $routes = [];

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

    if((string)@$request_variables['u']=='')
        $request_variables['u'] = $routes['default'];
    $route = @$routes[$request_variables['u']];
    if(!$route)
        $route = @$routes['404'];
    if($route)
        $route($request_variables);
}
