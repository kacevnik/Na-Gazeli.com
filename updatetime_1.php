<?php 
    include("include/db.php");

    if (isset($_POST['id']))      {$id = $_POST['id'];       $id = abs((int)$id);}
    if($_SESSION["admin"]){
        if($id){
            $pass = substr($_SESSION["admin"], 0, 32);
            $kod  = substr($_SESSION["admin"], 32, 32);
           $res = mysql_query("SELECT up_date FROM voditel WHERE id='$id' AND pass='$pass' AND kod='$kod'", $db);
           if(mysql_num_rows($res) > 0){
                $myr = mysql_fetch_assoc($res);
                $upDate = $myr["up_date"];
                if($upDate < time()){
                    $upDate = time() + 21600;
                    $upd = mysql_query("UPDATE voditel SET up_date='$upDate' WHERE id='$id'",$db);
                    echo 'Поднять через '.afterIn($upDate);
                }
           }    
        }
    }

?>