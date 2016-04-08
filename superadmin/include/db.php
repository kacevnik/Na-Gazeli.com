<?php 
$db = mysql_connect("localhost","admin","9564");
mysql_query("SET NAMES 'utf8'",$db);
mysql_select_db("gazel",$db);

include("lock.php")
?>