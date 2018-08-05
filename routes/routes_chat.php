<?php

$routes['chat_app'] = function($request_variables){
    header('Location: chat/chat_client.html');
};

require 'manager/util/pdo.php';

$routes['chat_app/db_setup'] = function($request_variables){
    pdo_execute(pdo_setup_db_sql());
    echo '<!doctype html>';
    echo 'DB tables are now setup.<br>';
    echo '<a href="../chat_app">Chat app</a>';
};

require 'manager/util/emoticons.php';
require 'manager/util/links.php';

function user(){
    return "anonymous";
}

// list messages
$routes['chat_list'] = function($request_variables){
    // OUT: $messages
    $messages = pdo_execute('SELECT * FROM (SELECT * FROM chat_messages ORDER BY creation_timestamp DESC LIMIT 15) AS res ORDER BY creation_timestamp ASC');
    // - produce HTML output
    // IN: $messages OUT: $output
    $output='<!doctype html>'."\n";
    $style = isset($request_variables['style']);
    $output .= $style?'<link rel="stylesheet" type="text/css" href="chat/chat_client.css">'."\n":'';
    foreach($messages as $message) {
        $sender = htmlspecialchars($message['sender']);
        $text = htmlspecialchars($message['message_text']);
        $text = parse_emoticons_expressions($text);
        $text = create_html_links($text);
        $output .= "<div class=\"line\"><em>$sender</em>: $text</div>\n";
    }
    echo $output;
};

// insert new message
$routes['chat_send'] = function($message){

    $unparsedBodyJSON = (string)@file_get_contents('php://input');
    // IN: $request OUT: $message
    //$unparsedBodyJSON = $request->getBody();
    // parse the JSON into an associative array
    $message = json_decode($unparsedBodyJSON, true);

    // $message has value ['message_text' => ..., 'sender' => ...];
    /////////////print($message['message_text']);
    // - SQL chat send
    // IN: $message
    $message['sender'] = user();
    $allow_anonymous_user = true;
    if(!$allow_anonymous_user && $message['sender']=='') {
        return "HTTP Status: 401 (UnAuthorized)";
    }else{
        if($message['sender']=='') {
            $message['sender'] = 'not authenticated sender user';
        }
        pdo_execute('INSERT INTO chat_messages (message_text, sender) VALUES (:message_text, :sender)', $message);
    }
};

$routes['user_logged'] = function($request_variables){
    echo user();
};
