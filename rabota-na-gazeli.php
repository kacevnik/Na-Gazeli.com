<?php 	
	include("include/db.php");
    
    if($_SESSION["admin"]){header("Location: lk.php"); exit();}
	
	$stranica = 4;
    
    $kolicestvoAnket = count(selTotalDriver());
    
    $avtoList = selAvto();
    $localList = selLocation();
    
    if (isset($_POST['submit']))    {$submit = $_POST['submit'];   $submit = trim(stripslashes(htmlspecialchars($submit)));}
    if (isset($_POST['email']))     {$email = $_POST['email'];     $email = trim(stripslashes(htmlspecialchars($email)));}
    if (isset($_POST['pass1']))     {$pass1 = $_POST['pass1'];     $pass1 = trim(stripslashes(htmlspecialchars($pass1)));}
    if (isset($_POST['pass2']))     {$pass2 = $_POST['pass2'];     $pass2 = trim(stripslashes(htmlspecialchars($pass2)));}
    if (isset($_POST['name']))      {$name = $_POST['name'];       $name = trim(stripslashes(htmlspecialchars($name)));}
    if (isset($_POST['phone']))     {$phone = $_POST['phone'];     $phone = trim(stripslashes(htmlspecialchars($phone)));}
    if (isset($_POST['com']))       {$com = $_POST['com'];         $com = trim(stripslashes(htmlspecialchars($com)));}
    if (isset($_POST['capcha']))    {$capcha = $_POST['capcha'];   $capcha = trim(stripslashes(htmlspecialchars($capcha)));}
    if (isset($_POST['avto']))      {$avto = $_POST['avto'];       $avto = abs((int)$avto);}
    if (isset($_POST['local']))     {$local = $_POST['local'];     $local = abs((int)$local);}
    
    if (!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i",$email)){unset($email);}else{$email = strtolower($email);}

    if (preg_match("/^[a-z0-9]{4,20}$/",$pass1)){$pass1 = $pass1;}else{unset($pass1);}
    if (preg_match("/^[a-z0-9]{4,20}$/",$pass2)){$pass2 = $pass2;}else{unset($pass2);}
    
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
        if($email){
            $selEmailDb = mysql_query("SELECT id FROM voditel WHERE email='$email'", $db);
            if(mysql_num_rows($selEmailDb) == 0){
                if($pass1 AND $pass2){
                    if($pass1 == $pass2){
                        if($name){
                            if($phone){
                            $phone = upPhone($phone);
                            $selPhoneDb = mysql_query("SELECT id FROM voditel WHERE phone='$phone'", $db);
                            if(mysql_num_rows($selPhoneDb) == 0){
                                if($local AND $avto){
                                if($capcha == $_SESSION["capcha"]){
                                    $today = date("Y-m-d");
                                    $resStat = mysql_query("SELECT count_new_user FROM stat WHERE today='$today'", $db);
                                    if(mysql_num_rows($resStat) > 0){
                                        $myrStat = mysql_fetch_assoc($resStat);
                                        $countNewUser = $myrStat["count_new_user"] + 1;
                                        $updStat = mysql_query("UPDATE stat SET count_new_user='$countNewUser' WHERE today='$today'",$db);   
                                    }else{
                                        $unixPostMail = time() + 1 + (86400 - time()%86400) - 10800;
                                        $add = mysql_query("INSERT INTO stat (count_new_user,today,unix_post_mail) VALUES ('1','$today','$unixPostMail')",$db);
                                    }
                                    $data = date("d-m-Y");
                                    $password = md5($pass1);
                                    $kod = md5(time());
                                    $time = time();
               					    $noviiVoditel = mysql_query("INSERT INTO voditel(name,phone,avto,raion,date,email,pass,kod,metka,reiting,propusk,dis,add_date,up_date,up_date_2,pokaz) VALUES ('$name','$phone','$avto','$local','$data','$email','$password','$kod','0','1','0','$com','$time','0','0','0')",$db);
                                    $subject = "Подтверждение регистрации: ";
                                    $header = "From: \"Na-Gazeli.com\" <admin@na-gazeli.com>";
                                    $message = "Здравствуйте<br>".$name."<p>Ваш логин для входа: ".$email."<br>Ваш пароль: ".$pass1."</p><p>Для подтверждения регистрации перейдите по ссылке:<br><a href='http://na-gazeli.com/mes.php?u=".$password.$kod."'>Подтверждение регистрации</a></p><p>Данное письмо сгенерировано автоматически. Отвечать на него не надо.<br>Спасибо.</p>";
                                    mail($email,$subject,$message,$header."\r\nContent-type:text/html;Charset=utf-8\r\n");
                                    $_SESSION['error'] = "<div class='error_plus'>Анкета добавлена. На указанную почту отправлено письмо с подстверждением регистрации.</div>";
                                    header("Location: rabota-na-gazeli.php#forma");
                                    exit();
                                        }
                                        else {$_SESSION['error'] = "<div class='error'>Укажите проверочный код с картинки!</div>";
                                            header("Location: rabota-na-gazeli.php#forma");
                                            exit();
                                        }
                                    }
                                    else {$_SESSION['error'] = "<div class='error'>Не выбраны тип транспорта и район!</div>";
                                        header("Location: rabota-na-gazeli.php#forma");
                                        exit();
                                    }
                                }
                                else {$_SESSION['error'] = "<div class='error'>Этот номер уже зарегистрирован в сисетме!</div>";
                                    header("Location: rabota-na-gazeli.php#forma");
                                    exit();
                                }
                            }
                            else {$_SESSION['error'] = "<div class='error'>Укажите свой номер телефона!</div>";
                                header("Location: rabota-na-gazeli.php#forma");
                                exit();
                            }
                        }
                        else{$_SESSION['error'] = "<div class='error'>Укажите полные Ф И О</div>";
                            header("Location: rabota-na-gazeli.php#forma");
                            exit();
                        }
                    }
        			else{$_SESSION['error'] = "<div class='error'>Пароли не совпадают!</div>";
                        header("Location: rabota-na-gazeli.php#forma");
                        exit();
                    } 
         		}
        		else{$_SESSION['error'] = "<div class='error'>Заполните поля паролей правильно. Латинские символы и цифры</div>";
        		  header("Location: rabota-na-gazeli.php#forma");
        		  exit();
                }
        	}
        	else{$_SESSION['error'] = "<div class='error'>Пользователь с таким E-mail уже зарегистрирован в системе!</div>";
        	   header("Location: rabota-na-gazeli.php#forma");
        	   exit();
            }
       	}
    	else{$_SESSION['error'] = "<div class='error'>Поле E-mail не заполнено, или заполнено неправильно!</div>";
    	   header("Location: rabota-na-gazeli.php#forma");
    	   exit();
        }
    }


?>
<!DOCTYPE html>
<html>
<head>
<meta name="keywords" content="работа на газели, работа на своей газели, работа на газели в москве" />
<title>Na-gazeli.com - Приглашаем водителей с личным авто для работы на Газели!</title>
<meta name="description" content="Работа на своей Газели в Москве и Московской области" />
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
                    <p>Дорогие друзья портал Na-Gazeli.com приглашает к сотрудничеству водителей с личным автотранспортом для работы в Московском регионе, и предлагает разместить в нашей базе частных водителей свою анкету. Что позволит получать Вам прямые заказы от потенциальных заказчиков, минуя диспетчеров. Для этого требуется пройти бесплатную регистрацию и создать свою анкету. Всего хорошего и больше заказов.</p>
                    <a href="drivers.php" class="button" style="margin: 10px 0 10px 152px;"><span><span>Посмотреть базу водителей</span></span></a>
						<h2>Анкета - Регистрация</h2><div class="dobavleno_anket">Добавлено анкет: <span><?php echo $kolicestvoAnket; ?></span></div>
						<a name="forma"></a>
<?php
 echo $_SESSION['error'];
 unset($_SESSION['error']); 
?>
						<form name="anketa" action="" method="post" onsubmit="return sub()">
                        <table>
                            <tr>
                                <td class="td_1" style="width: 236px;">Введите ваш E-mail адрес: *</td>
                                <td class="td_2"><input type="text" class="select2" value="" id="form_email" name="email" size="44" autocomplete="off" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="td_3">Введите действующий E-mail адрес. После регистрации анкеты на него прийдет письмо с подтверждением регистрации и другими иннструкциями. Кроме того данный E-mail будет использоваться для входа на данный сайт.</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="td_1">Придумайте пароль: *</td>
                                <td class="td_2"><input type="password" class="select2" value="" name="pass1" size="30" id="form_pass1"/></td>
                            </tr>
                            <tr>
                                <td class="td_1">Еще раз пароль: *</td>
                                <td class="td_2"><input type="password" class="select2" value="" name="pass2" size="30" id="form_pass2"/></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="td_3">Придумайте пароль, который будет служить Вам для аторизации на сайте. Пароль должен состоять из букв латинского алфавита и цифр. Минимальная длинна составляет 4 символа.</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="td_1">Укажите ФИО: *</td>
                                <td class="td_2"><input type="text" class="select2" value="" name="name" size="44"  id="form_name" autocomplete="off"/></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="td_3">Укажите Имя Фамилию и Отчество, например: Иванов Иван Иванович. Это поле является обязательным и служит для удобства обращения к Вам. Данные отобразаются в анкете.</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="td_1">Укажите ваш телефон: *</td>
                                <td class="td_2"><input type="text" class="select2" value="" name="phone" size="35"  id="form_phone" autocomplete="off"/></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="td_3">Введите действующий номер телефона (пример: 8 (923) 123-12-12), по которому с вами бедет связыватся заказчик. Поле является обязательным и показывается в <a href="drivers.php">списке анкет частных водителей</a></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="td_1">Выберите тип транспорта: *</td>
                                <td class="td_2">
                                <select name="avto" class="select" size="1" style="width: 229px; float:right" id="form_avto">
									<option selected="selected" value="0">Выберите тип транспорта</option>
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
									<option selected="selected" value="0">Выбор района</option>
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
                                <td colspan="2" class="td_2"><textarea name="com" maxlength="200"></textarea></td><td></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="td_3">По желанию напишите дополнительный комментарий о предостовляетмых вами услугах не более 200 символов. Заказчик также увидит его при просмотре списка.</td>
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
                                <td class="td_1 error_text" id="error_text"></td>
                                <td class="td_2"><input type="submit" name="submit" class="buttoncal" style="margin-top: 7px;" value="Отправить анкету"/></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="td_3"></td>
                                <td></td>
                            </tr>
                        </table>
						</form>
						</div>
						<noindex>
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