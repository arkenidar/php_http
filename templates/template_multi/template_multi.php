<?php
    $wrap = 'template_wrapper';
?>

<p><a href="multi">tab A</a> <a href="multi?tab=1">tab B</a> <a href="multi?tab=2">tab C</a></p>
<p><?=$_u('tab_content')?></p>
<a href="multi?tab=1">TEST: mvc multi-view switch to tab B</a>
