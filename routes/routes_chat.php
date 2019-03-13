<?php

require 'manager/chat/pdo.php';

$routes['chat/db_setup'] = function($request_variables){
    $db_type=pdo_db_type;
    $sql=file_get_contents("manager/chat/chat_db_setup_$db_type.sql");
    pdo_execute($sql);
    echo '<!doctype html>';
    echo "<pre>$sql</pre>";
    echo 'DB tables are now setup.<br>';
    echo '<a href="chat/">Chat app</a>';
};

require 'manager/chat/emoticons.php';
require 'manager/chat/links.php';

function user(){
    return $_SESSION['username']!=''?$_SESSION['username']:'anonymous';
}

// list messages
$routes['chat_list'] = function($request_variables){
    // OUT: $messages
    $messages = pdo_execute('SELECT * FROM (SELECT * FROM chat_messages ORDER BY creation_timestamp DESC LIMIT 15) AS res ORDER BY creation_timestamp ASC');
    // - produce HTML output
    // IN: $messages OUT: $output
    $output='<!doctype html>'."\n".'<meta charset="utf-8">'."\n";
    $optional_prefix=isset($request_variables['embedded'])?'../':'';
    $output.='<base href="'.$optional_prefix.'chat/">'."\n";
    $output.='<link rel="stylesheet" type="text/css" href="chat_client.css">'."\n";
    foreach($messages as $message) {
        $sender = htmlspecialchars($message['sender']);
        $text = htmlspecialchars($message['message_text']);
        $text = parse_emoticons_expressions($text);
        $text = create_html_links($text);
        $output .= "<div class=\"line\"><em>$sender</em>: $text</div>\n";
    }
    echo $output;
};

// list messages in json
$routes['chat/list.json'] = function($request_variables){
    $statement = pdo_execute('SELECT * FROM (SELECT * FROM chat_messages ORDER BY creation_timestamp DESC LIMIT 15) AS res ORDER BY creation_timestamp ASC');
    $messages = $statement->fetchAll(PDO::FETCH_ASSOC);
    $results = [];
    foreach($messages as $message) {
        $text = htmlspecialchars($message['message_text']);
        //$text = parse_emoticons_expressions($text); // placed in the frontend
        $text = create_html_links($text);
        $message['message_text'] = $text;
        $results[$message['id']] = $message;
    }
    header('Content-Type: application/json');
    $json = json_encode($results);
    echo $json;
};

// insert new message
$routes['chat_send'] = function($request_variables){
    $params=[':message_text'=>$request_variables['message_text'],
    ':sender'=>user()];
    //if(user()!='anonymous')
    pdo_execute('INSERT INTO chat_messages (message_text, sender) VALUES (:message_text, :sender)', $params);
};

$routes['user_logged'] = function($request_variables){
    echo user();
};