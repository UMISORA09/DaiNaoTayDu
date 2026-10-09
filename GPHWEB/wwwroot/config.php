<?php
$server="127.0.0.1:3306";
$username="root";
$password="123456";
$database="dnweb";
$conn=mysql_connect($server,$username,$password) or die ("could net connect mysql");
mysql_select_db($database,$conn) or die("could not open database");
mysql_query("SET @@character_set_connection=utf8,@@character_set_results=utf8,@@character_set_client=utf8");
?>