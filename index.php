<?php

$request_variables = $_REQUEST; // get from browser: useful for production.

if(''==((string)@$request_variables['u']))
    $request_variables['u']='mvc';

switch($request_variables['u']){
    case 'api':
        require 'api_test.php';
        echo http_api_test1($request_variables);
        break;

    case 'mvc':
        require 'mvc_test.php';
        echo http_mvc_test1($request_variables);
        break;
}
