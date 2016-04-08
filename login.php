<?php 	
	include("include/db.php");
    
	if($_SESSION["admin"]){header("Location: lk.php"); exit();}
    
	$stranica = 4;
    
    
    $kolicestvoAnket = count(selTotalDriver());
    
    $avtoList = selAvto();
    $localList = selLocation();
    
    if (isset($_POST['submit']))    {$submit = $_POST['submit'];   $submit = trim(stripslashes(htmlspecialchars($submit)));}
    if (isset($_POST['email']))     {$email = $_POST['email'];     $email = trim(stripslashes(htmlspecialchars($email)));}
    if (isset($_POST['pass']))      {$pass = $_POST['pass'];       $pass = trim(stripslashes(htmlspecialchars($pass)));}
    
    if (!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i",$email)){unset($email);}else{$email = strtolower($email);}

    if (preg_match("/^[a-z0-9]{4,20}$/",$pass)){$pass = $pass;}else{unset($pass);}    
	
    if($submit){
        if($email){
            if($pass){                                    
                $password = md5($pass);
                $sel = mysql_query("SELECT metka,pass,kod FROM voditel WHERE email='$email' AND pass='$password'", $db);
                if(mysql_num_rows($sel) > 0){
                    $myr = mysql_fetch_assoc($sel);
                    $metka = $myr["metka"];
                    $pass_md = $myr["pass"];
                    $kod = $myr["kod"];
                    if($metka == 1){
                        if(mysql_query("UPDATE voditel SET count_mail='1' WHERE email='$email' AND pass='$password'", $db)){
                            $_SESSION['admin'] = $pass_md.$kod;
                            $_SESSION['error'] = "<div class='error_plus'>Добро пожаловать!</div>";
                            header("Location: lk.php");
                            exit();    
                        }        
                    }
                    else{
                        $_SESSION['error'] = "<div class='error'>Данный аккаунт не активирован.</div>";
                        header("Location: login.php#forma");
                        exit();
                    }    
                }
                else{
                    $_SESSION['error'] = "<div class='error'>Пользователя с такими данными не существует в базе!</div>";
                    header("Location: login.php#forma");
                    exit();    
                }
            }
            else{
                $_SESSION['error'] = "<div class='error'>Заполните поле пароль правильно. Латинские символы и цифрыю.</div>";
                header("Location: login.php#forma");
                exit();
            }
        }
        else{
            $_SESSION['error'] = "<div class='error'>Поле E-mail не заполнено, или заполнено неправильно!</div>";
            header("Location: login.php#forma");
            exit();
        }
    }


?>
<!DOCTYPE html>
<html>
<head>
<meta name="keywords" content="работа на газели, работа на своей газели, работа на газели в москве" />
<title>Na-gazeli.com - Вход на сайт!</title>
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
						<h2>Вход в личный кабинет</h2>
						<a name="forma"></a>
<?php
 echo $_SESSION['error'];
 unset($_SESSION['error']); 
?>
						<form name="anketa" action="" method="post" onsubmit="return sub_login()">
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
                                <td class="td_1">Пароль: *</td>
                                <td class="td_2"><input type="password" class="select2" value="" name="pass" size="44"/></td>
                            </tr>
                                                       <tr>
                                <td colspan="2" class="td_3"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="td_1 error_text"></td>
                                <td class="td_2"><input type="submit" name="submit" class="buttoncal" style="margin-top: 7px;" value="Вход"/></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="td_3"></td>
                                <td></td>
                            </tr>
                        </table>
						</form>
                        <span style="padding-top: 12px; display: block;">
                            Забыли пароль? Вам <a href="new_pass.php">сюда</a>.<br />
                            <a href="">Регистрация</a>
                        </span>
						</div>
						<noindex>
					<!--	<div class="wrapper">
					  <ul class="list1 cols">
								<li><a href="#">At vero eos etaccusamus iusto</a></li>
								<li><a href="#">Odio dignissmos ducimus blanditiis</a></li>
								<li><a href="#">Praesentum voluptum deleniti</a></li>
							</ul>
							<ul class="list1 cols pad_left1">
								<li><a href="#">Molestias exceutpturi sint occaecati</a></li>
								<li><a href="#">Cupiditate nogn proghvident, similique</a></li>
								<li><a href="#">Sunt in culpa qui offiutrucia deserunt</a></li>
							</ul>
						</div>
					</div>-->
				</article>
			</div>
		</section>
<!-- / content -->
</noindex>
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