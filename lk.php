<?php 
	include("include/db.php");
	
    if(!$_SESSION["admin"]){header("Location: login.php"); exit();}
    
    if (isset($_GET['up']))    {$up = $_GET['up']; $up = abs((int)$up); if($up == 1 or $up == 2 ){}else{unset($up);}}
    
    
	$stranica = 4;
    $anketa = selAnketaLK($_SESSION["admin"]);
    $avtoList = selAvto();
    $localList = selLocation();
    
    if(time() < $anketa["up_date"]){$up_date = '<a class="dessel">Поднять через '.afterIn($anketa["up_date"]).'</a>';}
    if(time() >= $anketa["up_date"]){$up_date = '<a href="lk.php?up=1" class="up_date_1" id="up_date_1_'.$anketa["id"].'">Поднять в списке</a>';}
    if($anketa["up_date"] == 0){$up_date = '<a class="dessel">Поднять в списке</a>';}
    
    if(time() < $anketa["up_date_2"]){$up_date_2 = '<a class="dessel">Обновить через '.afterIn($anketa["up_date_2"]).'</a>';}
    if($anketa["up_date_2"] == 0){$up_date_2 = '<a class="dessel">Обновить</a>';}
    if(time() >= $anketa["up_date_2"]){$up_date_2 = '<a href="lk.php?up=2" class="up_date_2" id="up_date_2_'.$anketa["id"].'">Обновить</a>';}
    
    if($up1){
        if($anketa["up_date"] < time()){
            $up1 = time() + 21600;
            $id = $anketa["id"];
            $upd = mysql_query("UPDATE voditel SET up_date='$up1' WHERE id='$id'",$db);
            $_SESSION['error'] = "<div class='error_plus'>Время обновлено</div>";
            header("Location: lk.php");
            exit();

        }
    }
    
    if($up){
        $id = $anketa["id"];
        if($up ==1){
            if($anketa["up_date"] < time()){
                $up = time() + 21600;
                $upd = mysql_query("UPDATE voditel SET up_date='$up' WHERE id='$id'",$db);
                $_SESSION['error'] = "<div class='error_plus'>Время обновлено</div>";
                header("Location: lk.php");
                exit();
            }
        }
        else{
            if($anketa["up_date_2"] < time()){
                $up = time() + 259200;
                $id = $anketa["id"];
                    $today = date("Y-m-d");
                    $resStat = mysql_query("SELECT count_update_time FROM stat WHERE today='$today'", $db);
                    if(mysql_num_rows($resStat) > 0){
                        $myrStat = mysql_fetch_assoc($resStat);
                        $countUpdateTime = $myrStat["count_update_time"] + 1;
                        $updStat = mysql_query("UPDATE stat SET count_update_time='$countUpdateTime' WHERE today='$today'",$db);   
                    }else{
                        $unixPostMail = time() + 1 + (86400 - time()%86400) - 10800;
                        $add = mysql_query("INSERT INTO stat (count_update_time,today,unix_post_mail) VALUES ('1','$today','$unixPostMail')",$db);
                    }
                $upd = mysql_query("UPDATE voditel SET up_date_2='$up' WHERE id='$id'",$db);
                $_SESSION['error'] = "<div class='error_plus'>Время обновлено</div>";
                header("Location: lk.php");
                exit();
            }       
        }
    }

?>
<!DOCTYPE html>
<html>
<head>
<meta name="keywords" content="" />
<title>Личный кабинет - Анкета №id:<?php echo $anketa["id"]; ?></title>
<meta name="" />
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
<?php
 echo $_SESSION['error'];
 unset($_SESSION['error']);
 if($anketa["pokaz"] == 0){echo "<div class='error'>Ваша анкета находится на проверке.</div>";}
?>
						<h2>Анкета <i>id:<?php echo $anketa["id"]; ?></i></h2>
                        <ul class="lk_list">
                            <li><?php echo $up_date; ?></li>                     
                            <li><?php echo $up_date_2; ?></li>                     
                            <li><a href="update.php?id=<?php echo $anketa["id"]; ?>">Редактировать</a></li>                                         
                        </ul>
					       <table class="table_lk">
                                <tr>
                                    <td style="width: 200px;"><img src="avatar/<?php if($anketa["avatar"] == ""){ ?>gazel_ico.png<?php }else{ echo $anketa["avatar"]; } ?>" title="" width="78" height="78"/></td>
                                    <td>Аватарку можно загрузить во время редактирования.</td>
                               </tr>
                               <tr>
                                    <td>ФИО</td>
                                    <td><?php echo $anketa["name"]; ?></td>
                               </tr>
                               <tr>
                                    <td>Номер телефона</td>
                                    <td><?php echo $anketa["phone"]; ?></td>
                               </tr>
                               <tr>
                                    <td>Тип транспорта</td>
                                    <td><?php echo $avtoList[$anketa["avto"]]; ?></td>
                               </tr>
                               <tr>
                                    <td>Район</td>
                                    <td><?php echo $localList[$anketa["raion"]]; ?></td>
                               </tr>
                               <tr>
                                    <td>Дополнительный комментарий</td>
                                    <td><?php echo $anketa["dis"]; ?></td>
                               </tr>
                           </table>
                           <div class="del_user"><a href="delete_user.php" onclick ="return confirm('Вы точно хотите удалить?');">Удалить анкету.</a></div>
                           <h2>Часто задаваемые вопросы.</h2>
                           <p><b>Как обновить свою анкету?</b></p>
                           <p>Чтобы обновить свою анкету, достаточно кликнуть по кнопке "Обновить", которая находится над анкетой в верхней части личного кабинета. После нажатия кнопка изменит свой вид, и начнет отображать время до следующего обновления, которое будет через трое суток после нажатия. Следует помнить, что редактирование анкеты не обновит ее, даже после проверки администрацией сайта время останется прежним.</p>
                           
                           <p><b>Почему мне приходится обновлять анкету каждые три дня?</b></p>
                           <p>Увы, но такие правила проекта. Эта функция служит своеобразной гарантией достоверности заполняемых данных каждого водителя. Представим такую ситуацию: Недобросовестный водитель зарегистрировался и заполнил анкету из простого любопытства. Возможно он и вовсе не водитель, и не занимается грузоперевозками. Так вот если его анкета не исчезнет из общего списка, то потенциальный клиент может позвонить на указанный номер, и не дозвонится или получить отказ. И так может продолжаться до бесконечности, создавая тем самым ложную конкуренцию для добросовестных водителей. Система устроена таким образом, что через три дня анкета исчезнет из списка, если ее не обновить.</p>
                           
                           <p><b>Для чего нужна кнопка "Поднять в списке"?</b></p>
                           <p>В вопросе кроется ответ. Нажимая на кнопку "Поднять в списке", пользователь поднимает свою анкету в общем списке на самый вверх. И она находится там, пока другой пользователь не поднимет свою анкету, смещая тем самым первую анкету на позицию ниже. Для чего это сделано? Таким образом, осуществляется справедливая сортировка анкет. Чтобы не возникало претензий к администрации сайта. Если ты желаешь находиться всегда вверху списка, поднимай свою анкету чаще. Минимальный интервал времени, через которое можно воспользоваться данной кнопкой, составляет 6 часов.</p>
                           
                           <p><b>Как добавить аватарку к анкете?</b></p>
                           <p>Чтобы добавить картинку к своей анкете, воспользуйтесь кнопкой «Редактирование». Для аватарки можно использовать изображение в форматах: PNG, JPG и GIF. Следует помнить, что аватарка это дополнительный фактор привлечения внимания.</p>
                           
                           <p><b>Какой вид транспорта лучше указать в анкете?</b></p>
                           <p>Указывайте тот вид транспорта, на котором Вы предоставляете услуги, чтобы не вводить клиента в заблуждение. Если Ваш вид транспорта отсутствует в списке, то выберите наиболее схожий по характеристикам автомобиль, а более подробное описание, плюсы и выгоды укажите в дополнительном комментарии. И всегда следует помнить, что заказчик часто пользуется фильтром по виду интересующего его транспорта на странице с общим списком анкет.</p>
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