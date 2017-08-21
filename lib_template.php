<?php

function apply_template($template_file, $template_variables){
    $_ = function ($variable_name) use (&$template_variables){
        return $template_variables[$variable_name];
    };
    ob_start();
    require $template_file;
    $produced_template = ob_get_contents();
    ob_end_clean();
    return $produced_template;
}
