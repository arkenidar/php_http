<?php

function header_footer_wrapper($wrapped_content, $template_file){
    $template_variables = compact('wrapped_content');
    return apply_template($template_file, $template_variables);
}

function apply_template_no_prefix($template_file, $template_variables){
    $_u = function ($variable_name) use (&$template_variables){
        return $template_variables[$variable_name];
    };
    $_ = function ($variable_name) use (&$template_variables){
        return htmlspecialchars($template_variables[$variable_name]);
    };
    $_e = function($string_to_escape) {
        return htmlspecialchars((string)$string_to_escape);
    };

    ob_start();
    require $template_file;
    $produced_template = ob_get_contents();
    ob_end_clean();
    if((string)@$wrap!='') $produced_template = header_footer_wrapper($produced_template, $wrap);
    return $produced_template;
}

function apply_template($template_file, $template_variables){
    return apply_template_no_prefix(dirname(__FILE__).'/../templates/'.$template_file.'.php', $template_variables);
}
