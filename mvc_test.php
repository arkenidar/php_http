<?php

$request_variables = $_REQUEST; // get from browser: useful for production.
echo http_mvc_test1($request_variables);

function http_mvc_test1($request_variables){
    $template_file = 'template1.php';

    $id = htmlspecialchars((int)@$request_variables['id']);
    $title = "title $id";
    $content = "content $id.";
    $template_variables = compact('title', 'content');
    
    require 'lib_template.php';
    return apply_template($template_file, $template_variables);
}
