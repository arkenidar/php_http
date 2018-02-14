<?php
function http_mvc_multi($request_variables){
    $template_file = 'template_multi';

    $title = "title";

    $tab = htmlspecialchars((int)@$request_variables['tab']);
    $tab_template_file = ['template_tab_0','template_tab_1','template_tab_2'];

    require_once 'lib_template.php';
    $tab_content = apply_template($tab_template_file[$tab], []);
    $template_variables = compact('title', 'tab_content');
    return apply_template($template_file, $template_variables);
}
