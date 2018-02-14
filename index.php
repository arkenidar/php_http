<?php

$request_variables = $_REQUEST;
serve_request($request_variables);

function serve_request($request_variables){

    $routes = [];

    require_once 'routes/_router.php';

    if((string)@$request_variables['u']=='')
        $request_variables['u'] = $routes['default'];
    $route = @$routes[$request_variables['u']];
    if(!$route)
        $route = @$routes['404'];
    if($route)
        $route($request_variables);
}
