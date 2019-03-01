<?php

function http_api_test1($request_variables){
    $error_in_params_json='{"status":"access denied"}';
    if(!isset($request_variables['id'])) return $error_in_params_json;
    if(!isset($request_variables['message'])) return $error_in_params_json;

    $id = (int)$request_variables['id'];
    $message = (string)$request_variables['message'];

    $json_array = compact('id', 'message');
    echo json_encode($json_array);
}
