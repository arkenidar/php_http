<?php

$request_variables = $_REQUEST;
serve_request($request_variables);

function serve_request($request_variables){

    function http_mvc($mvc_content){
        $template_file = 'template_mvc.php';
        $title = 'title';
        require_once 'lib_template.php';
        $template_variables = compact('title', 'mvc_content');
        return apply_template($template_file, $template_variables);
    }

    switch($request_variables['u']){

        case 'api':
            require_once 'api_test.php';
            echo http_api_test1($request_variables);
            break;

        default:
        case 'test':
            require_once 'mvc_test.php';
            echo http_mvc(http_mvc_test1($request_variables));
            break;

        case 'multi':
            require_once 'mvc_multi.php';
            echo http_mvc(http_mvc_multi($request_variables));
            break;
    }

}
