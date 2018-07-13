<?php
$routes['default']='blank_with_template';
$routes['blank_with_template']=function(){
    require_once 'lib_template.php';
    $template_file = 'blank';
    echo apply_template($template_file, ['var'=>123]);
};
