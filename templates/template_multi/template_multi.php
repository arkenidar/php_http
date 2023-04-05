<?php
    $_wrap_with('template_wrapper');
?>

<p><a href="?r=multi&tab=0">tab A</a> <a href="?r=multi&tab=1">tab B</a> <a href="?r=multi&tab=2">tab C</a></p>
<p><?=$_u('tab_content')?></p>
<a href="?r=multi&tab=1">TEST: mvc multi-view switch to tab B</a>
