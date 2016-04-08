<?php 	
	include("include/db.php");
    
	if($_SESSION["admin"]){header("Location: lk.php"); exit();}
    
	$stranica = 4;
    
    if (isset($_GET['np']))       {$np = $_GET['np'];            $np = trim(stripslashes(htmlspecialchars($np)));}
    if (preg_match("/^[A-z0-9]{64,64}$/",$np)){$np = $np;}else{unset($np);}
    
    if (isset($_POST['submit_new_pass']))   {$submit_new_pass = $_POST['submit_new_pass'];   $submit_new_pass = trim(stripslashes(htmlspecialchars($submit_new_pass)));}
    if (isset($_POST['email']))             {$email = $_POST['email'];                       $email = trim(stripslashes(htmlspecialchars($email)));}
    if (isset($_POST['capcha']))            {$capcha = $_POST['capcha'];                     $capcha = strtolower(trim(stripslashes(htmlspecialchars($capcha))));}
    
    if (isset($_POST['submit']))            {$submit = $_POST['submit'];                    $submit = trim(stripslashes(htmlspecialchars($submit)));}
    if (isset($_POST['pass1']))             {$pass1 = $_POST['pass1'];                      $pass1 = trim(stripslashes(htmlspecialchars($pass1)));}
    if (isset($_POST['pass2']))             {$pass2 = $_POST['pass2'];                      $pass2 = trim(stripslashes(htmlspecialchars($pass2)));}
    
    if (preg_match("/^[A-z0-9]{4,20}$/",$pass1)){$pass1 = $pass1;}else{unset($pass1);}
    if (preg_match("/^[A-z0-9]{4,20}$/",$pass2)){$pass2 = $pass2;}else{unset($pass2);}
    
    if (preg_match("/^[A-z0-9]{4,4}$/",$capcha)){$capcha = $capcha;}else{unset($capcha);}
    
    if (!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i",$email)){unset($email);}else{$email = strtolower($email);}
	
    if($submit_new_pass){
        if($email){
            if($capcha == $_SESSION['capcha']){
                $resKodPoEmail = mysql_query("SELECT metka,pass,kod,name FROM voditel WHERE email='$email'",$db);
                if(mysql_num_rows($resKodPoEmail) > 0){
                    $myrKodPoEmail = mysql_fetch_array($resKodPoEmail);
                    if($myrKodPoEmail['metka'] == 1){
                        $pass = $myrKodPoEmail['pass'];
                        $kod = $myrKodPoEmail['kod'];
                        $name = $myrKodPoEmail['name'];
                        $np = $pass.$kod;
                        $dateVosPass = time() + 86400;
                        $siteName = "na-gazeli.com";
                        $subject = "Восстановление пароля на сайте: Na-gazeli.com";
                        $header = 'From: Na-gazeli.com <admin@na-gazeli.com>';
                        if($resDateVosPass = mysql_query("UPDATE voditel SET date_vos_pass='$dateVosPass' WHERE pass='$pass' AND kod='$kod'", $db)){
                            $url = "http://".$siteName."/new_pass.php?np=".$np."";
                            $message = "<h2 style='text-align: center'>Восстановление пароля</h2><p>Здравствуйте <b>".$name."</b></p><p>Для создания нового пароля для Вашего Аккаунта перейдите по ссылке:<br><a href='".$url."' target='blank'>Восстоновление пароля</a></p><p><b>Внимание ссылка действительна до: ".date("H:i d.m.Y",$dateVosPass)." (Сутки).</b></p><p>Пожалуйста, не отвечайте на это сообщение, оно было сгенерировано автоматически и только для информации.<br>Спасибо.</p>";
                            mail($email,$subject,$message,$header."\r\nContent-type:text/html;Charset=utf-8\r\n");
                            $_SESSION['error'] = "<div class='error_plus'>На Вашу почту отправлено письмо с инструкцией по восстановлению пароля. Спасибо.</div>";
                            header("Location: lk.php");
                            exit();
                        }
                        else{
                            $_SESSION['error'] = "<p class='error'>Не правильный запрос, ссылка недействительна:(</p>";
                            header("Location: new_pass.php");
                            exit();                            
                        }       
                    }
                    else{
                        $_SESSION['error'] = "<p class='error'>Аккаунт не активирован</p>";
                        header("Location: new_pass.php");
                        exit();   
                    }
                }
                else{
                    $_SESSION['error'] = "<p class='error'>Пользователь с эл. почтой <i>".$email."</i> не зарегистрирован на сайте</p>";
                    header("Location: new_pass.php");
                    exit();   
                }
            }
            else{
                $_SESSION['error'] = "<p class='error'>Не верно введены символы с картинки!</p>";
                header("Location: new_pass.php");
                exit();
            }    
        }
        else{
            $_SESSION['error'] = "<p class='error'>Поле Email не заполнено, или заполнено некорректно</p>";
            header("Location: new_pass.php");
            exit();
        }
    }
    if($submit){
        if($np){
            $passProverka = substr($np, 0, 32);
            $kodProverka = substr($np, 32, 32);
            $resNewPass = mysql_query("SELECT date_vos_pass,email,id FROM voditel WHERE pass='$passProverka' AND kod='$kodProverka' AND metka='1'", $db);
            if(mysql_num_rows($resNewPass) > 0){
                $myrNewPass = mysql_fetch_assoc($resNewPass);
                if(time() <= $myrNewPass["date_vos_pass"]){
                    if($pass1 and $pass2){
                        if($pass1 == $pass2){
                        $emailUser = $myrNewPass["email"];
                        $id = $myrNewPass["id"];
                        $pass = md5($pass1);
                        $kod =  md5(time());
                        if($resDateVosPass = mysql_query("UPDATE voditel SET date_vos_pass='0',pass='$pass',kod='$kod' WHERE id='$id'",$db)){
                            $_SESSION['error'] = "<div class='error_plus'>Пароль изменен. Спасибо.</div>";
                            header("Location: new_pass.php");
                            exit();                            
                        }    
                    }
                    else{
                        $_SESSION['error'] = "<p class='error'>Пароли не совпадают</p>";
                        header("Location: new_pass.php?np=".$np);
                        exit();                        
                    }   
                }
                else{
                    $_SESSION['error'] = "<p class='error'>Не все поля заполены, Пароли только латиница и цифры</p>";
                    header("Location: new_pass.php?np=".$np);
                    exit();                    
                }    
            }
            else{
                $_SESSION['error'] = "<p class='error'>Не правильный запрос, Жизнь ссылки закончилась.</p>";
                header("Location: new_pass.php");
                exit();                 
            }
        }
        else{
            $_SESSION['error'] = "<p class='error'>Не правильный запрос, ссылка недействительна:(</p>";
            header("Location: new_pass.php");
            exit();            
        }    
    }
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="keywords" content="Восстановление пароля Na-Gazeli.com" />
<title>Восстановление пароля</title>
<meta name="description" content="Восстановление пароля Na-Gazeli.com" />
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
<!-- content onsubmit="return sub()"  -->
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
						<h2>Восстановление пароля</h2>
						<a name="forma"></a>
<?php
    echo $_SESSION['error'];
    unset($_SESSION['error']);
    if(!$np){
?>
						<form name="new_pass" action="" method="post">
                        <table style="width: 100%;">
                            <tr>
                                <td class="td_1" style="width: 236px;">E-mail: *</td>
                                <td class="td_2"><input type="text" class="select2" value="" name="email" size="44" autocomplete="off" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="td_3"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="td_1" style="height: 72px;">Введите символы с картинки: *</td>
                                <td class="td_2"><span id="capcha"><img src="../capcha.php" class="img_capcha" onclick="reload_capcha()"></span><input type="text" class="select2" value="" name="capcha" size="20"  style="margin-top: 13px;" id="form_capcha" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="td_3">Введите символы с картинки для подтверждения о том, что вы не спам робот. Если символы неразборчевы, кликните по картинке для смены.</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="td_1 error_text"></td>
                                <td class="td_2"><input type="submit" name="submit_new_pass" class="buttoncal" style="margin-top: 7px;" value="Отправить"/></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="td_3"></td>
                                <td></td>
                            </tr>
                        </table>
						</form>
<?php }else{?>                        
						<form name="w_pass" action="" method="post">
                        <table style="width: 100%;">
                            <tr>
                                <td class="td_1" style="width: 236px;">Придумайте новый пароль: *</td>
                                <td class="td_2"><input type="password" class="select2" value="" name="pass1" size="44" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="td_3"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="td_1" style="width: 236px;">Повтарите новый пароль: *</td>
                                <td class="td_2"><input type="password" class="select2" value="" name="pass2" size="44" /></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="td_3">Следует помнить, что пароль должен состоять из латинских букв и цифр. Минимальная длинна должна состовлять не менее 4 символов.</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="td_1 error_text"></td>
                                <td class="td_2"><input type="submit" name="submit" class="buttoncal" style="margin-top: 7px;" value="Сменить пароль"/></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="td_3"></td>
                                <td></td>
                            </tr>
                        </table>
						</form>
<?php }?>
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