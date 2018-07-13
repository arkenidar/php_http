<?php

function http_mvc_test1($request_variables){
    $template_file = 'template1';

    $id = htmlspecialchars((int)@$request_variables['id']);
    $title = "title: id=$id";
    $dump = "id: $id";

    if(''==((string)@$request_variables['message']))
        $request_variables['message']='(no message)';

    $message = (string)@$request_variables['message'];
    $content = "message: '$message'";

    $template_variables = compact('title', 'dump', 'content');

    require_once 'lib_template.php';
    return apply_template($template_file, $template_variables);
}
