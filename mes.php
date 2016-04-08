<?php 	
	include("include/db.php");
	
	$stranica = 4;
    
    if (isset($_GET['u']))    {$u = $_GET['u'];   $u = trim(stripslashes(htmlspecialchars($u)));}
    if (preg_match("/^[A-z0-9]{64,64}$/",$u)){$u = $u;}else{unset($u);}
    
    if($u){
        $pass = substr($u, 0, 32);
        $kod  = substr($u, 32, 32);
        $res = mysql_query("SELECT id,metka,email,name,phone,dis FROM voditel WHERE pass='$pass' AND kod='$kod'", $db);
        if(mysql_num_rows($res) > 0){
            $myr = mysql_fetch_assoc($res);
            $metka = $myr["metka"];
            $id = $myr["id"];
            $name = $myr["name"];
            $email = $myr["email"];
            $phone = $myr["phone"];
            $com = $myr["dis"];
            if($metka == 0){
                $up = mysql_query("UPDATE voditel SET metka='1' WHERE id='$id'",$db);
                $adminEmail = "admin@na-gazeli.com";
                $subject = "Новая анкета ждет проверки: ";
                $header = "From: \"Na-Gazeli.com\" <admin@na-gazeli.com>";
                $message = "<p>Здравствуйте<br>На сайте зарегистрировался новый водитель.</p><p>Ф. И. О. : <b>".$name."</b><br>E-mail: <b>".$email."</b><br>Номер телефона: <b>".$phone."</b><br>Комментарий: <i>".$com."</i></p><p><a href='http://na-gazeli.com/work.php?u=".$pass.$kod."'>Рабочая область</a></p><p>Данное письмо сгенерировано автоматически. Отвечать на него не надо.<br>Спасибо.</p>";
                mail($adminEmail,$subject,$message,$header."\r\nContent-type:text/html;Charset=utf-8\r\n"); 
                
                $_SESSION['error'] = "<div class='error_plus'>Регистрация подтверждена. После проверки анкеты, она появится на сайте.</div>";
                header("Location: mes.php");
                exit();    
            }
            else{
                $_SESSION['error'] = "<div class='error'>Этот аккаунт уже активирован!</div>";
                header("Location: mes.php");
                exit();    
            }
        }
        else{
            $_SESSION['error'] = "<div class='error'>Ошибка запроса!</div>";
            header("Location: mes.php");
            exit();    
        }   
    }
    

?>
<!DOCTYPE html>
<html>
<head>
<meta name="keywords" content="работа на газели, работа на своей газели, работа на газели в москве" />
<title>Na-gazeli.com - Подтверждение регистрации!</title>
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
					<div class="pad" style="padding-left: 0;">
<?php
 echo $_SESSION['error'];
 unset($_SESSION['error']); 
?>

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