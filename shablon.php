<?php 
	include("include/db.php");
	
	$resNameSite = mysql_query("SELECT content FROM setings WHERE name='namesite'",$db);
	$myrNameSite = mysql_fetch_array($resNameSite);
	$nameSite = $myrNameSite[content];
	
	$resAdresSite = mysql_query("SELECT content FROM setings WHERE name='adressite'",$db);
	$myrAdresSite = mysql_fetch_array($resAdresSite);
	$adresSite = $myrAdresSite[content];
	
	$resPhone = mysql_query("SELECT content FROM setings WHERE name='phone'",$db);
	$myrPhone = mysql_fetch_array($resPhone);
	$phone = $myrPhone[content];

	$stranica = 1;

?>
<!DOCTYPE html>
<html>
<head>
<title>Главная</title>
<meta charset="utf-8"><link rel="icon" href="http://gazel/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="http://gazel/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<!--[if lt IE 9]>
	<script type="text/javascript" src="http://info.template-help.com/files/ie6_warning/ie6_script_other.js"></script>
	<script type="text/javascript" src="js/html5.js"></script>
<![endif]-->
</head>
<body id="page1">
			
<?php include("include/menu.php"); ?>  

<div class="body2">
	<div class="main">
<!-- content -->
		<section id="content">
<?php include("include/tabs.php"); ?>  
			<div class="wrapper marg_top2">
				<article class="col1">
					<div class="box2">
<?php include("include/dop_left.php"); ?>
					</div>
					<div class="box21">
<?php include("include/calcul_left.php"); ?> 
					</div>
				</article>
				<article class="col2 pad_left1">
					<div class="pad">
						<h2>Тарифы на "Газель" с водителем.</h2><br>
						Вы можете сделать зделать минимальный заказ на аренду газели с водителем на <b>2 часа</b> работы плюс <b>1 час</b> на подачу автомобиля к месту погрузки. Подробнее с тарифами можно ознакомиться ниже. По всем вопросам свяжитесь с диспечером: <b><?php echo $phone; ?></b>					
						<table width="572" class="main_table" style="margin-top:25px">
						  <tr class="main_table">
						    <td width="79" class="main_table_blue">Авто</td>
						    <td width="93" class="main_table_blue">Тонаж</td>
						    <td width="93" class="main_table_blue">Тарифы</td>
						    <td width="93" class="main_table_blue">Стоимость</td>
						    <td width="93" class="main_table_blue">Допол. час</td>
						    <td width="93" class="main_table_blue">1км за МКАД</td>
					      </tr>
						  <tr class="main_table">
						    <td rowspan="3" class="main_table_img"><img src="images/gazel_tent.png" title="Газель-тент Длина: 3м. Ширина: 1.9м Высота: 1.65м" width="78" height="78"></td>
						    <td class="main_table">1.5т-9куб</td>
						    <td class="main_table">1+2</td>
						    <td class="main_table">1200 руб.</td>
						    <td class="main_table">400 руб.</td>
						    <td class="main_table">11 руб/км</td>
					      </tr>
						  <tr class="main_table">
						    <td class="main_table">1.5т-9куб</td>
						    <td class="main_table">Внутрь ТТК</td>
						    <td class="main_table">1350 руб.</td>
						    <td class="main_table">450 руб.</td>
						    <td class="main_table">11 руб/км</td>
					      </tr>
						  <tr class="main_table">
						    <td class="main_table">1.5т-9куб</td>
						    <td class="main_table">Внутрь СК</td>
						    <td class="main_table">1350 руб.</td>
						    <td class="main_table">450 руб.</td>
						    <td class="main_table">11 руб/км</td>
					      </tr>
						  <tr class="main_table">
						    <td rowspan="3" class="main_table_img"><img src="images/gazel_budka.png" title="Газель-тент Длина: 3м. Ширина: 1.9м Высота: 1.65-2.15м" width="78" height="78"></td>
							<td class="main_table">1.5т-9куб</td>
						    <td class="main_table">1+2</td>
						    <td class="main_table">1200 руб.</td>
						    <td class="main_table">400 руб.</td>
						    <td class="main_table">11 руб/км</td>
					      </tr>
						  <tr class="main_table">
						    <td class="main_table">1.5т-9куб</td>
						    <td class="main_table">Внутрь ТТК</td>
						    <td class="main_table">1350 руб.</td>
						    <td class="main_table">450 руб.</td>
						    <td class="main_table">11 руб/км</td>
					      </tr>
						  <tr class="main_table">
						    <td class="main_table">1.5т-9куб</td>
						    <td class="main_table">Внутрь СК</td>
						    <td class="main_table">1350 руб.</td>
						    <td class="main_table">450 руб.</td>
						    <td class="main_table">11 руб/км</td>
					      </tr>
						  <tr class="main_table">
						    <td rowspan="3" class="main_table_img"><img src="images/gazel_tent_udlin.png" title="Газель-тент Длина: 4м. Ширина: 1.95м Высота: 2.2м" width="78" height="78"></td>
						    <td class="main_table">2т-17куб</td>
						    <td class="main_table">1+2</td>
						    <td class="main_table">1350 руб.</td>
						    <td class="main_table">450 руб.</td>
						    <td class="main_table">13 руб/км</td>
					      </tr>
						  <tr class="main_table">
						    <td class="main_table">2т-17куб</td>
						    <td class="main_table">Внутрь ТТК</td>
						    <td class="main_table">1410 руб.</td>
						    <td class="main_table">470 руб.</td>
						    <td class="main_table">13 руб/км</td>
					      </tr>
						  <tr class="main_table">
						    <td class="main_table">2т-17куб</td>
						    <td class="main_table">Внутрь СК</td>
						    <td class="main_table">1500 руб.</td>
						    <td class="main_table">500 руб.</td>
						    <td class="main_table">13 руб/км</td>
					      </tr>
						  <tr class="main_table">
						    <td rowspan="3" class="main_table_img"><img src="images/gazel_budka_udlin.png" title="Газель-тент Длина: 4м. Ширина: 1.95м Высота: 2.2м" width="78" height="78"></td>
						    <td class="main_table">2т-17куб</td>
						    <td class="main_table">1+2</td>
						    <td class="main_table">1350 руб.</td>
						    <td class="main_table">450 руб.</td>
						    <td class="main_table">13 руб/км</td>
					      </tr>
						  <tr class="main_table">
						    <td class="main_table">2т-17куб</td>
						    <td class="main_table">Внутрь ТТК</td>
						    <td class="main_table">1410 руб.</td>
						    <td class="main_table">470 руб.</td>
						    <td class="main_table">13 руб/км</td>
					      </tr>
						  <tr class="main_table">
						    <td class="main_table">2т-17куб</td>
						    <td class="main_table">Внутрь СК</td>
						    <td class="main_table">1500 руб.</td>
						    <td class="main_table">500 руб.</td>
						    <td class="main_table">13 руб/км</td>
					      </tr>
					  </table><p></p>
						<img src="images/left.png" alt="" class="left marg_right2" width="30" height="30"><p>Если Вам тяжело разобрать каракули в таблице, то можете воспользоваться калькулятором для автоматического подсчёта цены за аренду Газели.</p>
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
	</div>
</div>
<div class="main">
<!-- footer -->
	<footer>
<?php include("include/footer.php"); ?> 
		<div class="under2"></div>
		<div class="wrapper font_size">
<?php include("include/footer2.php"); ?> 
		</div>
	</footer>
<!-- / footer -->
</div>
</body>
</html>