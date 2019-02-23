<?php

/*
Copyright 2017 Dario Cangialosi

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

require 'pdo_conf.php';

function pdo_setup(){
	
	switch(pdo_db_type){

		case 'sqlite':
			$db_url = 'sqlite:db/db_chat.sqlite';
			$pdo = new PDO($db_url, "", "", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] );
			break;

		case 'postgres':
			$db_url = 'pgsql:host=localhost;';
			$pdo = new PDO($db_url, postgres_username, postgres_password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] );
			break;

		case 'mysql':
			$db_url = 'mysql:host=localhost;';
			$pdo = new PDO($db_url, mysql_username, mysql_password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] );
			break;
	}

	assert($pdo!=null);
	return $pdo;
}
$pdo=pdo_setup();
function pdo_execute($sql, $params = []) {
	global $pdo;
	$stat = $pdo->prepare($sql);
	assert($stat);
	$res = $stat->execute($params);
	assert($res);
	return $stat;
}
