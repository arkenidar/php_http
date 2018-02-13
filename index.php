<?php

$request_variables = $_REQUEST; // get from browser: useful for production.
serve_request($request_variables);

function serve_request($request_variables=[]){

if(''==((string)@$request_variables['u']))
    $request_variables['u']='mvc';

switch($request_variables['u']){
    case 'api':
        require_once 'api_test.php';
        echo http_api_test1($request_variables);
        break;

    case 'mvc':
        require_once 'mvc_test.php';
        echo http_mvc_test1($request_variables);
        break;

    case 'multi':
        require_once 'mvc_multi.php';
        echo http_mvc_multi($request_variables);
        break;
}

}
