<?php
$routes['']=function($request_variables){
    require_once 'templates/lib_template.php';
    $passwords=['user@gmail.com'=>'secret'];
    
    // actions (login, logout)
    if(@$request_variables['action']=='login' &&
    @$passwords[@$request_variables['user']]==@$request_variables['password'])
    $_SESSION['user']=$request_variables['user'];
    elseif(@$request_variables['action']=='logout')
    $_SESSION['user']='';
    
    $template_file = @$_SESSION['user']!=''?'logged':'login';
    echo apply_template($template_file,['user'=>@$_SESSION['user']]);
};
