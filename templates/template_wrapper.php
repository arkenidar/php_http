<!doctype html>
<meta name="viewport" content="width=device-width, initial-scale=1">

<a href="chat/db_setup">Chat</a> <a href="todo_list">To Do</a> <a href="multi?tab=1">mvc multi-view</a> <a href="test1?id=10&message=some text">mvc test 1</a> <a href="api?id=10&message=some text">api test</a>

<hr>
<?=$_u('wrapped_content')?>
<hr>

<a href="https://github.com/arkenidar/php_http">php_http files (this section of website) are available on arkenidar's github</a>

<script>
function location_href_class(){
    for(let link of document.querySelectorAll('a[href]')){
        if(window.location.href.endsWith(link.href)){
            link.classList.add('location_href')
        }
    }
}
location_href_class()
</script>
<style>
.location_href{ border: 1px dotted red; }
</style>