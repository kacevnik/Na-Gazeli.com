<?php 
    include("include/db.php");
    
    if (preg_match("/^[a-z0-9]{64,64}$/",$_SESSION["admin"])){$admin = $_SESSION["admin"];}else{unset($_SESSION["admin"]);}

    if($admin){
        $pass = substr($_SESSION["admin"], 0, 32);
        $kod  = substr($_SESSION["admin"], 32, 32);
        $res = mysql_query("SELECT id,name,email,avatar,phone FROM voditel WHERE pass='$pass' AND kod='$kod'", $db);
        if(mysql_num_rows($res) > 0){
            $myr = mysql_fetch_assoc($res);
            $m_avatar = $myr["avatar"];
            $m_id = $myr["id"];
            $m_name = $myr["name"];
            $m_email = $myr["email"];
            $m_phone = $myr["phone"];
            $m_time = time();
            if($m_avatar != ""){unlink('avatar/'.$m_avatar);}
            $res2 = mysql_query("SELECT id FROM del_user WHERE phone='$m_phone' OR email='$m_email'", $db);
            if(mysql_num_rows($res2) == 0){
                $ins = mysql_query("INSERT INTO del_user (name,email,date_d,phone) VALUES ('$m_name','$m_email','$m_time','$m_phone')",$db);
            }
            if($del = mysql_query("DELETE FROM voditel WHERE id='$m_id'",$db)){
                $today = date("Y-m-d");
                $resStat = mysql_query("SELECT count_delete_user FROM stat WHERE today='$today'", $db);
                if(mysql_num_rows($resStat) > 0){
                    $myrStat = mysql_fetch_assoc($resStat);
                    $countDeleteUser = $myrStat["count_delete_user"] + 1;
                    $updStat = mysql_query("UPDATE stat SET count_delete_user='$countDeleteUser' WHERE today='$today'",$db);
                }else{
                    $unixPostMail = time() + 1 + (86400 - time()%86400) - 10800;
                    $add = mysql_query("INSERT INTO stat (count_delete_user,today,unix_post_mail) VALUES ('1','$today','$unixPostMail')",$db);
                }
                unset($_SESSION["admin"]);
                $adminEmail = "admin@na-gazeli.com";
                $subject = "Водитель удалил анкету: ";
                $header = "From: \"Na-Gazeli.com\" <admin@na-gazeli.com>";
                $message = "<p>Здравствуйте.<br>На сайте Удалена анкета.</p><p>Ф. И. О. : <b>".$m_name."</b><br>E-mail: <b>".$m_email."</b><br>Номер телефона: <b>".$m_phone."</b></p><p>Данное письмо сгенерировано автоматически. Отвечать на него не надо.<br>Спасибо.</p>";
                mail($adminEmail,$subject,$message,$header."\r\nContent-type:text/html;Charset=utf-8\r\n");
                $_SESSION['error'] = "<div class='error_plus'>Анкета удалена</div>";
                header("Location: rabota-na-gazeli.php");
            }
        }    
    }

?>