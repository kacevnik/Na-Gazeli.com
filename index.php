<?php 
	include("include/db.php");
	
	$resMain = mysql_query("SELECT * FROM material WHERE id='1'",$db);
	$myrMain = mysql_fetch_array($resMain);

	$stranica = 1;

?>
<!DOCTYPE html>
<html>
<head>
<meta name="keywords" content="заказ газели" />
<title>Na-gazeli.com - Заказ газели, заказ газели недорого по Москве</title>
<meta name="description" content="Заказ Газели в Москве о Московской области" />
<meta charset="utf-8"/>
<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
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
<!-- content -->
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
					<div class="pad">
					<noindex>
						<h2>Тарифы на Заказ Газели с водителем.</h2><br/>
						Вы можете зделать минимальный заказ на аренду газели с водителем на <b>3 часа</b> работы плюс <b>1 час</b> на подачу автомобиля к месту погрузки. Подробнее с тарифами можно ознакомиться ниже. По всем вопросам связывайтесь с диспетчером: <b><?php echo $phone; ?></b> с 8.00 до 20.00					
						<table width="572" class="main_table" style="margin-top:25px;">
						  <tr class="main_table">
						    <td width="79" class="main_table_blue">Авто</td>
						    <td width="93" class="main_table_blue">Тонаж</td>
						    <td width="93" class="main_table_blue">Тарифы</td>
						    <td width="93" class="main_table_blue">Стоимость</td>
						    <td width="93" class="main_table_blue">Допол. час</td>
						    <td width="93" class="main_table_blue">1км за МКАД</td>
					      </tr>
						  <tr class="main_table">
						    <td rowspan="3" class="main_table_img"><img src="images/gazel_tent.png" title="Газель-тент Длина: 3м. Ширина: 1.9м Высота: 1.65м" width="78" height="78"/></td>
						    <td class="main_table">1.5т-9куб</td>
						    <td class="main_table">1+3</td>
						    <td class="main_table">1800 руб.</td>
						    <td class="main_table">450 руб.</td>
						    <td class="main_table">25 руб/км</td>
					      </tr>
						  <tr class="main_table">
						    <td class="main_table">1.5т-9куб</td>
						    <td class="main_table">Внутрь ТТК</td>
						    <td class="main_table">1900 руб.</td>
						    <td class="main_table">475 руб.</td>
						    <td class="main_table">25 руб/км</td>
					      </tr>
						  <tr class="main_table">
						    <td class="main_table">1.5т-9куб</td>
						    <td class="main_table">Внутрь СК</td>
						    <td class="main_table">2000 руб.</td>
						    <td class="main_table">500 руб.</td>
						    <td class="main_table">25 руб/км</td>
					      </tr>
						  <tr class="main_table">
						    <td rowspan="3" class="main_table_img"><img src="images/gazel_budka.png" title="Газель-тент Длина: 3м. Ширина: 1.9м Высота: 1.65-2.15м" width="78" height="78"/></td>
							<td class="main_table">1.5т-9куб</td>
						    <td class="main_table">1+3</td>
						    <td class="main_table">1800 руб.</td>
						    <td class="main_table">450 руб.</td>
						    <td class="main_table">25 руб/км</td>
					      </tr>
						  <tr class="main_table">
						    <td class="main_table">1.5т-9куб</td>
						    <td class="main_table">Внутрь ТТК</td>
						    <td class="main_table">1900 руб.</td>
						    <td class="main_table">475 руб.</td>
						    <td class="main_table">25 руб/км</td>
					      </tr>
						  <tr class="main_table">
						    <td class="main_table">1.5т-9куб</td>
						    <td class="main_table">Внутрь СК</td>
						    <td class="main_table">2000 руб.</td>
						    <td class="main_table">500 руб.</td>
						    <td class="main_table">25 руб/км</td>
					      </tr>
						  <tr class="main_table">
						    <td rowspan="3" class="main_table_img"><img src="images/gazel_tent_udlin.png" title="Газель-тент Длина: 4м. Ширина: 1.95м Высота: 2.2м" width="78" height="78"/></td>
						    <td class="main_table">2т-17куб</td>
						    <td class="main_table">1+3</td>
						    <td class="main_table">2000 руб.</td>
						    <td class="main_table">500 руб.</td>
						    <td class="main_table">25 руб/км</td>
					      </tr>
						  <tr class="main_table">
						    <td class="main_table">2т-17куб</td>
						    <td class="main_table">Внутрь ТТК</td>
						    <td class="main_table">2100 руб.</td>
						    <td class="main_table">525 руб.</td>
						    <td class="main_table">25 руб/км</td>
					      </tr>
						  <tr class="main_table">
						    <td class="main_table">2т-17куб</td>
						    <td class="main_table">Внутрь СК</td>
						    <td class="main_table">2200 руб.</td>
						    <td class="main_table">550 руб.</td>
						    <td class="main_table">25 руб/км</td>
					      </tr>
						  <tr class="main_table">
						    <td rowspan="3" class="main_table_img"><img src="images/gazel_budka_udlin.png" title="Газель-тент Длина: 4м. Ширина: 1.95м Высота: 2.2м" width="78" height="78"/></td>
						    <td class="main_table">2т-17куб</td>
						    <td class="main_table">1+3</td>
						    <td class="main_table">2000 руб.</td>
						    <td class="main_table">500 руб.</td>
						    <td class="main_table">25 руб/км</td>
					      </tr>
						  <tr class="main_table">
						    <td class="main_table">2т-17куб</td>
						    <td class="main_table">Внутрь ТТК</td>
						    <td class="main_table">2100 руб.</td>
						    <td class="main_table">525 руб.</td>
						    <td class="main_table">25 руб/км</td>
					      </tr>
						  <tr class="main_table">
						    <td class="main_table">2т-17куб</td>
						    <td class="main_table">Внутрь СК</td>
						    <td class="main_table">2200 руб.</td>
						    <td class="main_table">550 руб.</td>
						    <td class="main_table">25 руб/км</td>
					      </tr>
					  </table>
					  <p></p></noindex>
						<img src="images/left.png" alt="" class="left marg_right2" width="30" height="30"/><p>Если Вам тяжело разобрать каракули в таблице, то можете воспользоваться калькулятором для автоматического подсчёта цены на заказ Газели.</p>
						<h2><?php echo $myrMain[name]; ?></h2>
						<?php echo $myrMain[content]; ?>
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