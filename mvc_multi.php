<?php
function http_mvc_multi($request_variables=[]){
    $template_file = 'template_multi.php';

    $title = "title here";

    $tab = htmlspecialchars((int)@$request_variables['tab']);
    $tab_template_file = ['template_tab_0.php','template_tab_1.php','template_tab_2.php'];

    require_once 'lib_template.php';
    $tab_content = apply_template($tab_template_file[$tab], []);
    $template_variables = compact('title', 'tab_content');
    return apply_template($template_file, $template_variables);
}
