<?php 
    include("include/db.php");

    if (isset($_POST['id']))      {$id = $_POST['id'];       $id = abs((int)$id);}
    if($_SESSION["admin"]){
        if($id){
            $pass = substr($_SESSION["admin"], 0, 32);
            $kod  = substr($_SESSION["admin"], 32, 32);
           $res = mysql_query("SELECT up_date_2 FROM voditel WHERE id='$id' AND pass='$pass' AND kod='$kod'", $db);
           if(mysql_num_rows($res) > 0){
                $myr = mysql_fetch_assoc($res);
                $upDate = $myr["up_date_2"];
                if($upDate < time()){
                    $today = date("Y-m-d");
                    $resStat = mysql_query("SELECT count_update_time FROM stat WHERE today='$today'", $db);
                    if(mysql_num_rows($resStat) > 0){
                        $myrStat = mysql_fetch_assoc($resStat);
                        $countUpdateTime = $myrStat["count_update_time"] + 1;
                        $updStat = mysql_query("UPDATE stat SET count_update_time='$countUpdateTime' WHERE today='$today'",$db);   
                    }else{
                        $unixPostMail = time() + 1 + (86400 - time()%86400) - 10800;
                        $add = mysql_query("INSERT INTO stat (count_update_time,today,unix_post_mail) VALUES ('1','$today','$unixPostMail')",$db);
                    }
                    $upDate = time() + 259200;
                    $upd = mysql_query("UPDATE voditel SET up_date_2='$upDate',time_message='$upDate' WHERE id='$id'",$db);
                    $upDate = $upDate - 60;
                    echo 'Обновить через '.afterIn($upDate);
                }
           }    
        }
    }

?>