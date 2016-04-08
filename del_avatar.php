<?php 
    include("include/db.php");
    
    if (preg_match("/^[a-z0-9]{64,64}$/",$_SESSION["admin"])){$admin = $_SESSION["admin"];}else{unset($_SESSION["admin"]);}

    if (isset($_POST['id']))      {$id = $_POST['id'];       $id = abs((int)$id);}
    if($_SESSION["admin"]){
        if($id){
            $pass = substr($_SESSION["admin"], 0, 32);
            $kod  = substr($_SESSION["admin"], 32, 32);
            $res = mysql_query("SELECT avatar FROM voditel WHERE id='$id' AND pass='$pass' AND kod='$kod'", $db);
            if(mysql_num_rows($res) > 0){
                $myr = mysql_fetch_assoc($res);
                $m_avatar = $myr["avatar"];
                if(unlink('avatar/'.$m_avatar)){
                    $upd = mysql_query("UPDATE voditel SET avatar='' WHERE id='$id'",$db);
                    echo '<img style="float: left;" src="avatar/gazel_ico.png" title="" width="78" height="78"/>';
                }
           }    
        }
    }

?>