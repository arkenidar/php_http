<?php

require_once 'templates/lib_template.php';

function http_mvc_test1($request_variables){
    $template_file = 'template1';

    $id = htmlspecialchars(isset($request_variables['id'])?(int)$request_variables['id']:0);
    $title = "title: id=$id";
    $dump = "id: $id";

    if(!isset($request_variables['message']))
        $request_variables['message']='(no message)';

    $message = $request_variables['message'];
    $content = "message: '$message'";

    $template_variables = compact('title', 'dump', 'content');

    echo apply_template($template_file, $template_variables);
}
