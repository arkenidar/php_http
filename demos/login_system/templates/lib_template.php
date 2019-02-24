<?php
function apply_template($template_file, $template_variables, $path_prefix=null){
    if($path_prefix==null) // auto path prefix
    $template_file=dirname(__FILE__).'/../templates/'.$template_file.'.php';

    $_ = function ($variable_name) use (&$template_variables){
        return htmlspecialchars($template_variables[$variable_name]);
    }; // get variable & escape it

    $_u = function ($variable_name) use (&$template_variables){
        return $template_variables[$variable_name];
    }; // get variable & don't escape it (left Unescaped)

    $_e = function($value_to_escape) {
        return htmlspecialchars($value_to_escape);
    }; // escape something

    ob_start();
    require $template_file;
    $produced_template = ob_get_contents();
    ob_end_clean();

    if(isset($wrap)) // wrapper template
    $produced_template = apply_template($wrap,
    array_merge($template_variables,['wrapped_content'=>$produced_template]));

    return $produced_template;
}
