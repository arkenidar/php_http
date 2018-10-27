<?php
$routes['']=function(){
    require_once 'templates/lib_template.php';
    $template_file = 'blank';
    echo apply_template($template_file, ['var'=>123]);
};
