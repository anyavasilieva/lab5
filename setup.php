<?php
ini_set('display_errors', 'Off');

$MYSQL_HOST = "localhost";
$MYSQL_USER = "root";
$MYSQL_PASSWORD = "";
$MYSQL_BASE = "db";


$sql = new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_BASE);

if($sql->connect_error) die("Error: ".$sql->connect_error);

?>