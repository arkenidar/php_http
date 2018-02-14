<?php

$request_variables = $_REQUEST;
serve_request($request_variables);

function http_mvc($mvc_content){
    $template_file = 'template_mvc.php';
    $title = 'title';
    require_once 'lib_template.php';
    $template_variables = compact('title', 'mvc_content');
    return apply_template($template_file, $template_variables);
}

function serve_request($request_variables){

    $routes = [];

    $routes['default'] = 'test';
    $routes['404'] = function($request_variables){
        echo 'not found';
    };
    $routes['api'] = function($request_variables){
        require_once 'api_test.php';
        echo http_api_test1($request_variables);
    };
    $routes['test'] = function($request_variables){
        require_once 'mvc_test.php';
        echo http_mvc(http_mvc_test1($request_variables));
    };
    $routes['multi'] = function($request_variables){
        require_once 'mvc_multi.php';
        echo http_mvc(http_mvc_multi($request_variables));
    };

    if((string)@$request_variables['u']=='')
        $request_variables['u'] = $routes['default'];
    $route = @$routes[$request_variables['u']];
    if(!$route)
        $route = @$routes['404'];
    if($route)
        $route($request_variables);
}
