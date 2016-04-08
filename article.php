<?php 
	include("include/db.php");

	$stranica = 2;
    //Проверка выборки главных настроек из БД
    if(mainSET()){$myrow = mainSET();}else{exit("Ошибка 001");}
    
    //Проверка, если ГЕТ переменной нет то на первую страницу.
    if($_GET["page"]){ $page = $_GET["page"]; $page = abs((int)$page);}
        if($page == 1){
            header("Location:article.php");
    }
    if(!$page){$page = 1;}
    
    //Выборка из БД числа статей на каждой странице        
    
    $resTotalArt = mysql_query("SELECT id FROM articles WHERE pokaz='1'",$db);
    $total = mysql_num_rows($resTotalArt);
?>
<!DOCTYPE html>
<html>
<head>
<meta name="keywords" content="na-gazeli.com, статьи" />
<title>Все статьи сайта Na-Gazeli.com</title>
<meta name="description" content="Все статьи сайта Na-Gazeli.com" />
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
					<div class="page">
<?php 
    if(selNovoStr($page,$myrow[0]["count_art_page"])){$selNovoStr = selNovoStr($page,$myrow[0]["count_art_page"]); foreach($selNovoStr as $item){
?>                    
                    <h2><a href="art_view.php?al=<?php echo $item["alias"]; ?>"><?php echo $item["name"]; ?></a></h2><br/>
					<div class="calendar"><div class="calendarmes"><?php echo dateArticle($item["date"]); ?></div><div class="calendarcis"><?php echo substr($item["date"],2); ?></div></div><p><?php echo $item["description"]; ?></p>
					<p><a href="art_view.php?al=<?php echo $item["alias"]; ?>">Подробнее...</a></p>
                    
<?php unset($selComments);unset($selFoto);}}else{echo "В базе нет статей!";} ?>                                    
                        <div class="article_nav">
                            <ul>
<?php
    $total = intval((($total - 1) / $myrow[0]["count_art_page"]) + 1); 
    if ($page != 1) $pervpage = '<li><a href=article.php?page=1>Первая</a></li><li><a href=article.php?page='. ($page - 1) .'>Предыдущая</a></li>';
                
    if ($page != $total) $nextpage = '<li><a href=article.php?page='. ($page + 1) .'>Следующая</a></li><li><a href=article.php?page=' .$total. '>Последняя</a></li>';
                
    if($page - 3 > 0) $page3left = ' <li><a href=article.php?page='. ($page - 3) .'>'. ($page - 3) .'</a></li>';
    if($page - 2 > 0) $page2left = ' <li><a href=article.php?page='. ($page - 2) .'>'. ($page - 2) .'</a></li>';
    if($page - 1 > 0) $page1left = '<li><a href=article.php?page='. ($page - 1) .'>'. ($page - 1) .'</a></li>';
                
    if($page + 3 <= $total) $page3right = '<li><a href=article.php?page='. ($page + 3) .'>'. ($page + 3) .'</a></li>';
    if($page + 2 <= $total) $page2right = '<li><a href=article.php?page='. ($page + 2) .'>'. ($page + 2) .'</a></li>';
    if($page + 1 <= $total) $page1right = '<li><a href=article.php?page='. ($page + 1) .'>'. ($page + 1) .'</a></li>';
                             
    if ($total > 1){
        Error_Reporting(E_ALL & ~E_NOTICE);
                
        echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left."<li class='active_page'><a href=''>".$page.'</a></li>'.$page1right.$page2right.$page3right.$page4right.$page5right.$nextpage;
    }
?>
                            </ul>                    
                        </div>
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