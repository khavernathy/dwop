<?php

$host = "lol";
$user = "not"
$pass = "telling";
$db = "u";

$mysqlconn = mysql_connect($host, $user, $pass) or die(mysql_error());
mysql_select_db($db, $mysqlconn) or die(mysql_error());
?>
