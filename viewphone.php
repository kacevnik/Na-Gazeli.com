<?php 
    include("include/db.php");

    if (isset($_POST['id']))      {$id = $_POST['id'];       $id = abs((int)$id);}
    
    if($id){
       $res = mysql_query("SELECT phone FROM voditel WHERE id='$id'", $db);
       if(mysql_num_rows($res)){
            $myr = mysql_fetch_assoc($res);
            $phone = $myr["phone"];
            echo '<span>'.$phone.'</span>';
       }    
    }

?>