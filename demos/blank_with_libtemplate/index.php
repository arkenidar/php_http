<?php
$request_variables = $_REQUEST;

try {
    if(array_key_exists('REQUEST_URI',$_SERVER))
    serve_request($request_variables);
}catch(Exception $e){
    echo 'Caught exception: ',$e->getMessage(),"\n";
}

function serve_request($request_variables){
    $routes = [];
    require 'routes/_router.php';
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

function ob_serve_request($request_variables){
    ob_start();
    serve_request($request_variables);
    $produced_output = ob_get_contents();
    ob_end_clean();
    return $produced_output;
}
