<?php 	
	include("include/db.php");
    
    if(!$_SESSION["admin"]){header("Location: login.php"); exit();}
	
    $passProverka = substr($_SESSION["admin"], 0, 32);
    $kodProverka  = substr($_SESSION["admin"], 32, 32);
    
    if (isset($_GET['id']))    {$id = $_GET['id'];   $id = abs((int)$id);}
    if (isset($_GET['del']))   {$del = $_GET['del']; $del = abs((int)$del); if($del != 1){unset($del);}}
    
    if(!$id){header("Location: lk.php"); exit();}
    
    $resProverka = mysql_query("SELECT email,name,dis,avto,raion,phone,uper,avatar FROM voditel WHERE id='$id' AND pass='$passProverka' AND kod='$kodProverka' AND metka='1'", $db);
    if(mysql_num_rows($resProverka) > 0){
        $myrP = mysql_fetch_assoc($resProverka);
        $m_name = $myrP['name'];
        $m_phone = $myrP['phone'];
        $m_email = $myrP['email'];
        $m_avto = $myrP['avto'];
        $m_local = $myrP['raion'];
        $m_com = $myrP['dis'];
        $m_upper = $myrP['uper'];
        $m_avatar = $myrP['avatar'];
    }
    else{
        header("Location: login.php"); exit();    
    }
          
	$stranica = 4;
    
    $avtoList = selAvto();
    $localList = selLocation();
    
    if($del){
        if(unlink('avatar/'.$m_avatar)){
            $upd = mysql_query("UPDATE voditel SET avatar='' WHERE id='$id' AND pass='$passProverka' AND kod='$kodProverka'",$db);
            $_SESSION['error'] = "<div class='error_plus'>Изображение удалено.</div>";
            header("Location: update.php?id=".$id);
            exit();
        }
        else{
            $_SESSION['error'] = "<p class='error'>Ошибка удаления аватарки</p>";
            header("Location: update.php?id=".$id);
            exit();     
        }
    }
    
    if (isset($_POST['submit']))    {$submit = $_POST['submit'];   $submit = trim(stripslashes(htmlspecialchars($submit)));}
    if (isset($_POST['name']))      {$name = $_POST['name'];       $name = trim(stripslashes(htmlspecialchars($name)));}
    if (isset($_POST['phone']))     {$phone = $_POST['phone'];     $phone = trim(stripslashes(htmlspecialchars($phone)));}
    if (isset($_POST['com']))       {$com = $_POST['com'];         $com = trim(stripslashes(htmlspecialchars($com)));}
    if (isset($_POST['avto']))      {$avto = $_POST['avto'];       $avto = abs((int)$avto);}
    if (isset($_POST['local']))     {$local = $_POST['local'];     $local = abs((int)$local);}
    
    if($avto <= 0){unset($avto);}else{$avto = $avto;}
    if($local <= 0){unset($local);}else{$local = $local;}
       
    if($name){$name = ucwords_ru(strtolower_ru($name));}
    
    if($phone == "" OR $phone == " "){unset($phone);}
    $phone = str_replace("(","", $phone);
    $phone = str_replace(")","", $phone);
    $phone = str_replace("-","", $phone);
    $phone = str_replace(" ","", $phone);
    $phone = str_replace("+","", $phone);

    if($submit){
        if($name){
            if($phone){
                $phone = upPhone($phone);
                $selPhoneDb = mysql_query("SELECT id FROM voditel WHERE phone='$phone'", $db);
                if(mysql_num_rows($selPhoneDb) == 0 ||  $phone == $m_phone){
                    if($local AND $avto){
                        $upper = $m_upper;
                        if($name != $m_name){$upper = $upper.$name."/".$m_name."<br>"; $uper_end = "------------------------------------------------------<br>";}
                        if($phone != $m_phone){$upper = $upper.$phone."/".$m_phone."<br>"; $uper_end = "------------------------------------------------------<br>";}
                        if($avto != $m_avto){$upper = $upper.$avtoList[$avto]."/".$avtoList[$m_avto].")<br>"; $uper_end = "------------------------------------------------------<br>";}
                        if($local != $m_local){$upper = $upper.$localList[$local]."/".$localList[$m_local]."<br>"; $uper_end = "------------------------------------------------------<br>";}
                        if($com != $m_com){$upper = $upper."Изменение комментария<br>"; $uper_end ="------------------------------------------------------<br>";}
                        if($_FILES['file']['size'] > 0){                            
                            $upper = $upper."Изменение аватарки<br/>";
                             $uper_end = "------------------------------------------------------<br>";
                        }
                        if($upper == ""){$upper_message = "Изменения отсутствуют.";}else{$upper_message = "Есть изменения.";
                        if($_FILES['file']['size'] > 0){
                            $file = $_FILES['file'];
                            $name_a = $file["name"];
                            $type = $file["type"];
                            $size = $file["size"];
                            $newName = md5(microtime());
                            $dir = "avatar/";
                            $List = array(".php", ".phtml", ".php3", ".php4");
                            foreach($List as $i){
                                if(preg_match("/$i\$/i",$name_a)){
                                    $_SESSION['error'] = "<p class='error'>Неверный файл</p>";
                                    header("Location: update.php?id=".$id);
                                    exit();    
                                }
                            }
                            if($type != "image/gif" && $type != "image/png" && $type != "image/jpg" && $type != "image/jpeg"){
                                $_SESSION['error'] = "<p class='error'>Неверный файл</p>";
                                header("Location: update.php?id=".$id);
                                exit();    
                            }        
                            if($size > 5 * 1024 *1024){
                                $_SESSION['error'] = "<p class='error'>Слишком большой размер файла.</p>";
                                header("Location: update.php?id=".$id);
                                exit();    
                            }
                            $newName = $newName.".".substr($type, strlen("image/"));
                            $uploadPach = $dir.$newName;
                            
                            if($m_avatar != ""){
                                if(!unlink('avatar/'.$m_avatar)){
                                    $_SESSION['error'] = "<p class='error'>Ошибка удаления файла</p>";
                                    header("Location: update.php?id=".$id);
                                    exit(); 
                                }
                            }
        
                            if(is_uploaded_file($file["tmp_name"])){
                                if(move_uploaded_file($file["tmp_name"], $uploadPach)){
                                    list($w1, $h1) = getimagesize($uploadPach);
                                    if($w1 >= $h1){$w = $h1;}else{$w = $w1;}
                                    if($h1 >= $w1){$h = $w1;}else{$h = $h1;}
                                    $x = ($w1 / 2) - ($w / 2);
                                    $y = ($h1 / 2) - ($h / 2);
                                    $ext = strtolower(end(explode(".", $name_a)));
                                    if ($ext == "gif"){ 
                                        $img = imagecreatefromgif($uploadPach);
                                    } else if($ext =="png"){ 
                                        $img = imagecreatefrompng($uploadPach);
                                    } else { 
                                        $img = imagecreatefromjpeg($uploadPach);
                                    }
                                    $tci = imagecreatetruecolor(100, 100);
                                    imagecopyresampled($tci, $img, 0, 0, $x, $y, 100, 100, $w, $h);
                                    if ($ext == "gif"){ 
                                        imagegif($tci, $uploadPach);
                                    } else if($ext =="png"){ 
                                        imagepng($tci, $uploadPach);
                                    } else { 
                                        imagejpeg($tci, $uploadPach, 84);
                                    }
                                    $upd_av = mysql_query("UPDATE voditel SET avatar='$newName' WHERE pass='$passProverka' AND kod='$kodProverka' AND id='$id'", $db);
                                }    
                            }
                            else{
                                $_SESSION['error'] = "<p class='error'>Ошибка загрузки!</p>";
                                header("Location: update.php?id=".$id);
                                exit();    
                            }
                        }
                        $upper = $upper.$uper_end;
                        $update = mysql_query("UPDATE voditel SET name='$name',phone='$phone',avto='$avto',raion='$local',uper='$upper',pokaz='0',dis='$com' WHERE pass='$passProverka' AND kod='$kodProverka' AND id='$id'", $db);
                        $adminEmail = "admin@na-gazeli.com";
                        $subject = "Анкета ждет проверки";
                        $header = "From: \"Na-Gazeli.com\" <admin@na-gazeli.com>";
                        $message = "Здравствуйте Администратор<br>Анкета ждет проверки<p><b>".$upper_message."</b><br>Ф. И. О. : <b>".$name."</b><br>E-mail: <b>".$m_email."</b><br>Номер телефона: <b>".$phone."</b><br>Комментарий: <i>".$com."</i></p><p><a href='http://na-gazeli.com/work.php?u=".$passProverka.$kodProverka."'>Рабочая область</a><p>Данное письмо сгенерировано автоматически. Отвечать на него не надо.<br>Спасибо.</p>";
                        mail($adminEmail,$subject,$message,$header."\r\nContent-type:text/html;Charset=utf-8\r\n");
                        $_SESSION['error'] = "<div class='error_plus'>Изменения сохранены. Спасибо.</div>";
                        header("Location: lk.php");
                        exit();
                        }
                    }
                    else {
                        $_SESSION['error'] = "<div class='error'>Не выбраны тип транспорта и район!</div>";
                        header("Location: update.php?id=".$id);
                        exit();
                    }
                }
                else {
                    $_SESSION['error'] = "<div class='error'>Этот номер уже зарегистрирован в сисетме!</div>";
                    header("Location: update.php?id=".$id);
                    exit();
                }
            }
            else {
                $_SESSION['error'] = "<div class='error'>Укажите свой номер телефона!</div>";
                header("Location: update.php?id=".$id);
                exit();
            }
        }
        else{
            $_SESSION['error'] = "<div class='error'>Укажите полные Ф И О</div>";
            header("Location: update.php?id=".$id);
            exit();
        }
    }


?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="keywords" content="" />
        <title>Редактирование анкеты пользователя</title>
        <meta name="description" content="" />
        <meta charset="utf-8"/>
        <link rel="icon" href="favicon.ico" type="image/x-icon"/>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="css/reset.css" type="text/css" media="all"/>
        <link rel="stylesheet" href="css/layout.css" type="text/css" media="all"/>
        <link rel="stylesheet" href="css/style.css" type="text/css" media="all"/>
<!--[if lt IE 9]>
	<script type="text/javascript" src="http://info.template-help.com/files/ie6_warning/ie6_script_other.js"></script>
	<script type="text/javascript" src="js/html5.js"></script>
<![endif]-->
<?php include("include/galaryjs.php"); ?>
</head>
<body id="page1">
			
<?php include("include/menu.php"); ?>  

<div class="body2">
	<div class="main">
<!-- content  -->
		<section id="content">
<?php include("include/tabs.php"); ?>  
			<div class="wrapper marg_top2">
				<article class="col1">
					<div class="box2">
<?php include("include/dop_left.php"); ?>
					</div>
<?php include("include/calcul_left.php"); ?> 
				</article>
				<article class="col2 pad_left1">
					<div class="pad" style="padding-left: 0; padding-right: 0px;">
						<h2>Редактирование анкеты</h2>
						<a name="forma"></a>
<?php
 echo $_SESSION['error'];
 unset($_SESSION['error']); 
?>
						<form name="anketa" action="" method="post" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td class="td_1" id="res_del_avatar"><img style="float: left;" src="avatar/<?php if($m_avatar == ""){ ?>gazel_ico.png<?php }else{ echo $m_avatar; } ?>" title="" width="78" height="78"/><?php if(!$m_avatar == ""){ ?><a class="del_avatar" href="update.php?del=1&id=<?php echo $id ?>" id="del_avatar_<?php echo $id; ?>">Удалить аватарку</a><?php } ?></td>
                                <td class="td_2"><input type="file" class="select2" name="file" size="44"/></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="td_3">Для загрузки аватарки используйте изображения в формате GIF, PNG, JPG и JPEG</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="td_1">Укажите ФИО: *</td>
                                <td class="td_2"><input type="text" class="select2" value="<?php echo $m_name; ?>" name="name" size="44"  id="form_name" autocomplete="off"/></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="td_3">Укажите Имя Фамилию и Отчество, например: Иванов Иван Иванович. Это поле является обязательным и служит для удобства обращения к Вам. Данные отобразаются в анкете.</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="td_1">Укажите ваш телефон: *</td>
                                <td class="td_2"><input type="text" class="select2" value="<?php echo $m_phone; ?>" name="phone" size="35"  id="form_phone" autocomplete="off"/></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="td_3">Введите действующий номер телефона (пример: 8 (923) 123-12-12), по которому с вами бедет связыватся заказчик. Поле является обязательным и показывается в <a href="drivers.php">списке анкет частных водителей</a></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="td_1">Выберите тип транспорта: *</td>
                                <td class="td_2">
                                <select name="avto" class="select" size="1" style="width: 229px; float:right" id="form_avto">
									<option selected="selected" value="<?php echo $m_avto; ?>"><?php echo $avtoList[$m_avto]; ?></option>
<?php foreach($avtoList as $key => $v){ ?>
									<option value="<?php echo $key; ?>"><?php echo $v; ?></option>

<?php } ?>                  									
							</select>
                            </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="td_3">Выберите тип транспота на котором вы работаете, Это поле обязательное и служит для поиска и сортировки по данному критерию.</a></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="td_1">Выбор района: *</td>
                                <td class="td_2">
                                <select name="local" class="select" size="1" style="width: 330px; float:right" id="form_local">
									<option selected="selected" value="<?php echo $m_local; ?>"><?php echo $localList[$m_local]; ?></option>
<?php foreach($localList as $keyl => $vl){ ?>
									<option value="<?php echo $keyl; ?>"><?php echo $vl; ?></option>

<?php } ?>                  									
							</select>
                            </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="td_3">Выберите наиболее удобный район для работы или ближайший от вашего проживания. Это поле обязательное и служит для поиска и сортировки по данному критерию.</a></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="td_2">Дополнительный комментарий: </td><td></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="td_2"><textarea name="com" maxlength="200"><?php echo $m_com; ?></textarea></td><td></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="td_3">По желанию напишите дополнительный комментарий о предостовляетмых вами услугах не более 200 символов. Заказчик также увидит его при просмотре списка.</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="td_1 error_text" id="error_text"></td>
                                <td class="td_2"><input type="submit" name="submit" class="buttoncal" style="margin-top: 7px;" value="Сохранить изменения"/></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="td_3"></td>
                                <td></td>
                            </tr>
                        </table>
						</form>
						</div>
				</article>
			</div>
		</section>
<!-- / content -->
	</div>
</div>
<div class="main">
<!-- footer -->
	<footer>
<?php /*include("include/footer.php"); */?> 
		<div class="under2"></div>
		<div class="wrapper font_size">
<?php include("include/footer2.php"); ?> 
		</div>
	</footer>
<!-- / footer -->
</div>
<?php include("include/scetcik.php"); ?>
</body>
</html>