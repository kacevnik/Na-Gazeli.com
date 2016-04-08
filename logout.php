<?php 
    include("include/db.php");
    if(!$_SESSION["admin"]){
        header("Location: index.pnp");
        exit();
    }
    else{
        unset($_SESSION["admin"]);
        header("Location: ".$urlka);
        exit();
    }
?>