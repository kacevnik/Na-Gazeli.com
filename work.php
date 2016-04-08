<?php 	
	include("include/db.php");
    
    if (isset($_GET['u']))       {$u = $_GET['u'];            $u = trim(stripslashes(htmlspecialchars($u)));}
    if (preg_match("/^[A-z0-9]{64,64}$/",$u)){$u = $u;}else{unset($u);}
    
    if($u){
	
    $passProverka = substr($u, 0, 32);
    $kodProverka  = substr($u, 32, 32);
    
    $resProverka = mysql_query("SELECT id,email,name,dis,avto,raion,phone,uper,pokaz,up_date_2,up_date,time_message,avatar FROM voditel WHERE pass='$passProverka' AND kod='$kodProverka' AND metka='1'", $db);
    if(mysql_num_rows($resProverka) > 0){
        $myrP = mysql_fetch_assoc($resProverka);
        $m_name = $myrP['name'];
        $m_phone = $myrP['phone'];
        $m_avto = $myrP['avto'];
        $m_local = $myrP['raion'];
        $m_com = $myrP['dis'];
        $m_upper = $myrP['uper'];
        $m_id = $myrP['id'];
        $m_pokaz = $myrP['pokaz'];
        $m_up_date_1 = $myrP['up_date'];
        $m_up_date = $myrP['up_date_2'];
        $m_email = $myrP['email'];
        $m_time = $myrP['time_message'];
        $m_avatar = $myrP['avatar'];
    }
    else{
        exit();
    }
          
	$stranica = 4;
    
    $avtoList = selAvto();
    $localList = selLocation();
    
    if (isset($_POST['submit']))    {$submit = $_POST['submit'];           $submit = trim(stripslashes(htmlspecialchars($submit)));}
    if (isset($_POST['submit2']))   {$submit2 = $_POST['submit2'];         $submit2 = trim(stripslashes(htmlspecialchars($submit2)));}
    if (isset($_POST['name']))      {$name = $_POST['name'];               $name = trim(stripslashes(htmlspecialchars($name)));}
    if (isset($_POST['phone']))     {$phone = $_POST['phone'];             $phone = trim(stripslashes(htmlspecialchars($phone)));}
    if (isset($_POST['com']))       {$com = $_POST['com'];                 $com = trim(stripslashes(htmlspecialchars($com)));}
    if (isset($_POST['avto']))      {$avto = $_POST['avto'];               $avto = abs((int)$avto);}
    if (isset($_POST['local']))     {$local = $_POST['local'];             $local = abs((int)$local);}
    if (isset($_POST['error_mes'])) {$error_mes = $_POST['error_mes'];     $error_mes = trim(stripslashes(htmlspecialchars($error_mes)));}
    if (isset($_POST['chek']))      {$chek = $_POST['chek'];               $chek = trim(stripslashes(htmlspecialchars($chek)));}
    
    if($avto <= 0){unset($avto);}else{$avto = $avto;}
    if($local <= 0){unset($local);}else{$local = $local;}
    
    
    if($phone == "" OR $phone == " "){unset($phone);}
    $phone = str_replace("(","", $phone);
    $phone = str_replace(")","", $phone);
    $phone = str_replace("-","", $phone);
    $phone = str_replace(" ","", $phone);
    $phone = str_replace("+","", $phone);
    
    if($submit){
        if($chek == date("H"."9564")){
            if($phone and $name and $avto and $local){
                $time = time();
                $phone = upPhone($phone);
                $subject = "Анкета прошла проверку";
                if($m_up_date == 0){$m_up_date = time() + 259200;}else{$m_up_date = $m_up_date;}
                if($m_up_date_1 == 0){$m_up_date_1 = time() + 21600;}else{$m_up_date_1 = $m_up_date_1;}
                if($m_time == 0){$m_time = time() + 259200;}else{$m_time = $m_time;}
                $m_upper = "";
                $header = "From: \"Na-Gazeli.com\" <admin@na-gazeli.com>";
                if($resDateVosPass = mysql_query("UPDATE voditel SET name='$name',phone='$phone',dis='$com',avto='$avto',raion='$local',pokaz='1',up_date_2='$m_up_date',up_date='$m_up_date_1',time_message='$m_up_date',uper='$m_upper',error_message='$m_upper' WHERE pass='$passProverka' AND kod='$kodProverka'", $db)){
                    $message = "<h2 style='text-align: center'>Поздравляем!</h2><p>Уважаемый <b>".$name."</b></p><p>Ваша анкета прошла проверку, и теперь отображается в списке.</p><p>Пожалуйста, не отвечайте на это сообщение, оно было сгенерировано автоматически и только для информации.<br>Спасибо.</p>";
                    mail($m_email,$subject,$message,$header."\r\nContent-type:text/html;Charset=utf-8\r\n");
                    $_SESSION['error'] = "<div class='error_plus'>Запрос прошел</div>";
                    header("Location: work.php?u=".$u);
                    exit();
                }   
            }
            else{
                $_SESSION['error'] = "<p class='error'>Незаполнены рабочие поля:(</p>";
                header("Location: work.php?u=".$u);
                exit();     
            }    
        }
        else{
            $_SESSION['error'] = "<p class='error'>Проверочное поле не заполненно:(</p>";
            header("Location: work.php?u=".$u);
            exit(); 
        }        
    }
    
    if($submit2){
        if($chek == date("H"."9564")){
            if($error_mes){
                if($phone and $name and $avto and $local){
                    $subject = "Внимание ошибка!";
                    $time = time()+86400;
                    $header = "From: \"Na-Gazeli.com\" <admin@na-gazeli.com>";
                    if($resDateVosPass = mysql_query("UPDATE voditel SET error_message='$error_mes',time_message='$time',pokaz='0' WHERE pass='$passProverka' AND kod='$kodProverka'", $db)){
                        $message = "<h2 style='text-align: center'>Внимание!</h2><p>Уважаемый <b>".$name."</b></p><p>Ваша анкета не прошла проверку из-за ошибки.</p><p>Для ее исправления, Вам следует ".$error_mes.".</p><p>Пожалуйста, не отвечайте на это сообщение, оно было сгенерировано автоматически и только для информации.<br>Спасибо.</p>";
                        mail($m_email,$subject,$message,$header."\r\nContent-type:text/html;Charset=utf-8\r\n");
                        $_SESSION['error'] = "<div class='error_plus'>Письмо с ошибкой отправлено адресату.</div>";
                        header("Location: work.php?u=".$u);
                        exit();
                    }   
                }
                else{
                    $_SESSION['error'] = "<p class='error'>Незаполнены рабочие поля:(</p>";
                    header("Location: work.php?u=".$u);
                    exit();     
                }
            }
            else{
                $_SESSION['error'] = "<p class='error'>Сообщение об ошибке поле не заполненно:(</p>";
                header("Location: work.php?u=".$u);
                exit(); 
            }    
        }
        else{
            $_SESSION['error'] = "<p class='error'>Проверочное поле не заполненно:(</p>";
            header("Location: work.php?u=".$u);
            exit(); 
        }        
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="keywords" content="" />
        <title>Проверка Анкеты</title>
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
						<h2>Проверка Анкеты ID#<?php echo $m_id; ?></h2>
						<a name="forma"></a>
<?php
 echo $_SESSION['error'];
 unset($_SESSION['error']);
 if($m_pokaz == 1){echo "<div class='error_plus'>Анкета уже проверина и находится в списке показов!</div>";}
 if($m_upper != ""){echo "<div class='error'>".$m_upper."</div>";}
 if($m_up_date == 0){echo "<div class='error_plus'>Новый пользователь!</div>";}
?>
						<form name="anketa" action="" method="post">
                        <table>
                            <tr>
                                    <td style="width: 200px;"><img src="avatar/<?php if($m_avatar == ""){ ?>gazel_ico.png<?php }else{ echo $m_avatar; } ?>" title="" width="78" height="78"/></td>
                               </tr>
                            <tr>
                                <td class="td_1">ФИО: *</td>
                                <td class="td_2"><input type="text" class="select2" value="<?php echo $m_name; ?>" name="name" size="44" autocomplete="off"/></td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="td_1">Телефон: *</td>
                                <td class="td_2"><input type="text" class="select2" value="<?php echo $m_phone; ?>" name="phone" size="35" autocomplete="off"/></td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="td_1">Тип транспорта: *</td>
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
                                <td></td>
                            </tr>
                            <tr>
                                <td class="td_1">Район: *</td>
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
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="td_2">Дополнительный комментарий: </td><td></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="td_2"><textarea name="com" maxlength="200"><?php echo $m_com; ?></textarea></td><td></td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="td_2">Сообщение об ошибке (Вам следует...) </td><td></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="td_2"><textarea name="error_mes" maxlength="200"></textarea></td><td></td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="td_1">Проверочный код: *</td>
                                <td class="td_2"><input type="text" class="select2" value="" name="chek" size="44" autocomplete="off"/></td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="td_1 error_text" id="error_text"></td>
                                <td class="td_2"><input type="submit" name="submit" class="buttoncal" style="margin-top: 7px;" value="Одобрить"/>
                                <input type="submit" name="submit2" class="buttoncal" style="margin-top: 7px; margin-right: 15px;" value="Отправить ошибку"/></td>
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
<?php } ?>