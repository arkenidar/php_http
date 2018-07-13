<?php

$request_variables = $_REQUEST;
serve_request($request_variables);

function serve_request($request_variables){

    $routes = [];

    require_once 'routes/_router.php';

	$path_info = substr((string)@$_SERVER['PATH_INFO'], 1);
	if(''==((string)@$request_variables['u']) && ''!=$path_info)
		$request_variables['u'] = $path_info;

    if((string)@$request_variables['u']=='')
        $request_variables['u'] = $routes['default'];
    $route = @$routes[$request_variables['u']];
    if(!$route)
        $route = @$routes['404'];
    if($route)
        $route($request_variables);
}
