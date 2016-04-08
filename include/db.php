<?php
    $db = mysql_connect("localhost","root","");
    mysql_query("SET NAMES 'utf8'",$db);
    mysql_select_db("joomlamix_gazel",$db);
    
   	session_start();
    
    $urlka = $_SERVER['HTTP_REFERER'];
    
    define('SL', DIRECTORY_SEPARATOR); 
    define('SITE_ROOT', SL.'home'.SL.'gazel'.SL.'www/'); 
    define('CLASS_PACH', SITE_ROOT.'classes');
    define('ADMIN_EMAIL','kacevnik@yandex.ru');

    include("function.php");
      
    errorMail(3);
    mailStatistic();

?>