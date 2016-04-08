<?php
	include("include/db.php");
    $null = "";
    
    $s = mysql_query("SELECT email,id FROM voditel WHERE email!='$null'",$db);
    $r = mysql_fetch_assoc($s);
    do{
        $email = $r["email"];
        $id = $r["id"];
        $s2 = mysql_query("SELECT id FROM voditel WHERE email='$email' AND id!='$id'",$db);
        if(mysql_num_rows($s2) > 0){
            $r2 = mysql_fetch_assoc($s2);
            $id2 = $r2['id'];
            echo $id." - ".$id2;
            exit("Совпадение");
        }    
    }
    while($r = mysql_fetch_assoc($s));
?>