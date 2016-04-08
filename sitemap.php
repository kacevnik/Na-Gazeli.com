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

	$stranica = 2;

?>
<!DOCTYPE html>
<html>
<head>
<meta name="keywords" content="заказ газели, заказать газель, заказ газели москва, заказать газель москва, аренда газели" />
<title><?php echo $nameSite." - Карта сайта"; ?></title>
<meta name="description" content="Карта сайта - удобный поиск интересующей информации" />
<meta charset="utf-8"/>
<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all"/>
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all"/>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all"/>
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
					<div class="p_body"></div>
					<h2><a href="sitemap.php">Карта сайта</a></h2><br/>
                    <ul>
                        <li><a href="index.php" target="_blank">- Главная</a></li>
                        <li><a href="stati-page-1.php" target="_blank">- Статьи</a></li>
                            <ul style="margin-left: 25px;">
<?php 
    $resArticleSM = mysql_query("SELECT name,alias FROM articles ORDER BY id",$db);
    if(mysql_num_rows($resArticleSM) > 0){
        $myrArticleSM = mysql_fetch_assoc($resArticleSM);
        do{   
?>
                                <li><a href="art_view.php?al=<?php echo $myrArticleSM["alias"]; ?>" target="_blank">- <?php echo $myrArticleSM["name"]; ?></a></li>
<?php
        }
        while($myrArticleSM = mysql_fetch_assoc($resArticleSM));
    }
    else{
?>
                                <li>В базе нет статей</li>        
<?php
    }
?>
                            </ul>
                        <li><a href="rabota-na-gazeli.php" target="_blank">- Сотрудничество</a></li>
                        <li><a href="on-line-zakaz.php" target="_blank">- On-line Заказ</a></li>
                        <li><a href="tarifi.html" target="_blank">- Тарифы</a></li>
                    </ul>
                    
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