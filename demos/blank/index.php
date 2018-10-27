<?php
$request_variables = $_REQUEST;

try {
    serve_request($request_variables);
}catch(Exception $e){
    echo 'Caught exception: ',$e->getMessage(),"\n";
}

function serve_request($request_variables){
    $routes = [];
    require_once 'routes/_router.php';
    $route=null;
    if(isset($request_variables['r']))
        $route=$request_variables['r'];
    else if(isset($_SERVER['PATH_INFO']))
        $route=substr($_SERVER['PATH_INFO'],1);
    if(!isset($routes[$route]))
        $route=$routes['404'];
    else
        $route=$routes[$route];

    $route($request_variables);
}
