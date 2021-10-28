<?php

$username = $_REQUEST['username'];
$password = $_REQUEST["password"];
$email1 = $_REQUEST["email1"];
$email2 = $_REQUEST["email2"];

$password = hex2bin($password);
$username = hex2bin($username);


 http_response_code(200);




?>