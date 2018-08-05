<?php

function create_html_links($text){

    $callback_function=function($url){
        $url=htmlspecialchars($url[1]);
        return '<a href="'.$url.'" '.
        'target="_blank">'.$url.'</a>';
    };
    
    $html = preg_replace_callback(
        '/((https?|ftps?)\:\/\/\S*)/',
        $callback_function,
        $text);
    return $html;
}
