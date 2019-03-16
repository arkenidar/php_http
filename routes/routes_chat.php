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

function user(){
    return $_SESSION['username']!=''?$_SESSION['username']:'anonymous';
}

// list messages in json
$routes['chat/list.csv'] = function($request_variables){
    $statement = pdo_execute('SELECT * FROM (SELECT id,message_text,sender,creation_timestamp FROM chat_messages ORDER BY creation_timestamp DESC LIMIT 15) AS res ORDER BY creation_timestamp ASC');
    header('Content-Type: text/plain');
    $csv='';
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
        $csv.=$row['id'].','.$row['message_text'].','.$row['sender'].','.$row['creation_timestamp']."\n";
    echo $csv;
};

// insert new message
$routes['chat/send'] = function($request_variables){
    $params=[':message_text'=>$request_variables['message_text'],
    ':sender'=>user()];
    //if(user()!='anonymous')
    pdo_execute('INSERT INTO chat_messages (message_text, sender) VALUES (:message_text, :sender)', $params);
};

$routes['user_logged'] = function($request_variables){
    echo user();
};