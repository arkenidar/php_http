<?php

require_once 'templates/lib_template.php';

function http_mvc_multi($request_variables){
    $template_file = 'template_multi/template_multi';

    $title = "title";

    $tab = htmlspecialchars((int)@$request_variables['tab']);
    $tab_template_file = ['template_multi/template_tab_0','template_multi/template_tab_1','template_multi/template_tab_2'];

    $tab_content = apply_template($tab_template_file[$tab], []);
    $template_variables = compact('title', 'tab_content');
    return apply_template($template_file, $template_variables);
}
