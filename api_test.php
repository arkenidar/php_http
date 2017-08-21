<?php

$request_variables = ['id'=>3]; // hard-coded: useful for testing.
echo http_api_test1($request_variables);

function http_api_test1($request_variables){

    $id = (int)@$request_variables['id'];
    $title = "title $id";
    $content = "content $id.";
    $json_array = compact('title', 'content');

    return json_encode($json_array);
}
