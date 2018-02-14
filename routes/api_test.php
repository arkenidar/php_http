<?php

function http_api_test1($request_variables){

    $id = (int)@$request_variables['id'];
    $message = (string)@$request_variables['message'];

    $json_array = compact('id', 'message');
    return json_encode($json_array);
}
