<?php
function apply_template($template_file, $template_variables, $path_prefix=null){
    global $wrap, $_u;

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

    $_wrap_with = function($wrapped_with){
        global $wrap;
        if(isset($wrap)==false) $wrap = [];
        $wrap[] = $wrapped_with;
    };

    $_get_wrapped_content = function(){
        global $_u;
        return array_pop($_u('wrapped_content'));
    };

    ob_start();
    require $template_file;
    $produced_template = ob_get_contents();
    ob_end_clean();

    if(isset($wrap) && count($wrap)>0){ // wrapper template

        if(isset($template_variables['wrapped_content'])==false)
            $template_variables['wrapped_content'] = [];

        $template_variables['wrapped_content'][] = $produced_template;

        $produced_template = apply_template( array_pop($wrap), $template_variables);
    }

    return $produced_template;
}
