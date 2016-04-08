<?php
    session_start();
    
    if(isset($_POST['submit'])){
        $file = $_FILES['file'];
        $name = $file["name"];
        $type = $file["type"];
        $size = $file["size"];
        $newName = md5(microtime());
        $dir = "uploads/";
        $List = array(".php", ".phtml", ".php3", ".php4");
        foreach($List as $i){
            if(preg_match("/$i\$/i",$name)){
                $_SESSION['error'] = "<p class='error'>Неверный файл 1</p>";
                header("Location: my_file.php");
                exit();    
            }
        }
        if($type != "image/gif" && $type != "image/png" && $type != "image/jpg" && $type != "image/jpeg"){
            $_SESSION['error'] = "<p class='error'>Неверный файл 2</p>";
            header("Location: my_file.php");
            exit();    
        }
        
        if($size > 5 * 1024 *1024){
            $_SESSION['error'] = "<p class='error'>Слишком большой размер.</p>";
            header("Location: my_file.php");
            exit();    
        }
        $newName = $newName.".".substr($type, strlen("image/"));
        $uploadPach = $dir.$newName;
        
        if(is_uploaded_file($file["tmp_name"])){
            if(move_uploaded_file($file["tmp_name"], $uploadPach)){
                list($w1, $h1) = getimagesize($uploadPach);
                if($w1 >= $h1){$w = $h1;}else{$w = $w1;}
                if($h1 >= $w1){$h = $w1;}else{$h = $h1;}
                $x = ($w1 / 2) - ($w / 2);
                $y = ($h1 / 2) - ($h / 2);
                $img = imagecreatefromjpeg($uploadPach);
                $tci = imagecreatetruecolor(100, 100);
                imagecopyresampled($tci, $img, 0, 0, $x, $y, 100, 100, $w, $h);
                imagejpeg($tci, $uploadPach, 84);
                print_r($file);
                echo  $w1.",".$h1.",".$w.",".$h; 

            }    
        }
        else{
            $_SESSION['error'] = "<p class='error'>Ошибка загрузки!</p>";
            header("Location: my_file.php");
            exit();    
        }
        

    }

  
?>
<form  method="post" action="my_file.php" enctype="multipart/form-data">
    <input name="file" type="file"/><br /><br />
    <input type="submit" name="submit" value="Загрузить"/>
</form>
<?php
    echo $_SESSION['error'];
    unset($_SESSION['error']);
?>