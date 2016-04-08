<?php 
	include("include/db.php");
    
    if (isset($_GET['al']))       {$al = $_GET['al'];            $al = trim(stripslashes(htmlspecialchars($al)));}
    if (articleData($al)){$articleData = articleData($al);}else{header("Location: article.php");exit();}

	$stranica = 2;
?>
<!DOCTYPE html>
<html>
<head>
<meta name="keywords" content="<?php echo $articleData[0]["m_keys"]; ?>" />
<title><?php echo $articleData[0]["title"]; ?></title>
<meta name="description" content="<?php echo $articleData[0]["m_keys"]; ?>" />
<meta charset="utf-8"/><link rel="icon" href="http://gazel/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="http://gazel/favicon.ico" type="image/x-icon"/>
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
					<h2><a href="art_view.php?al=<?php echo $articleData[0]["alias"]; ?>"><?php echo $articleData[0]["name"]; ?></a></h2><br />
					<div class="calendar"><div class="calendarmes"><?php echo dateArticle($articleData[0]["date"]); ?></div><div class="calendarcis"><?php echo substr($articleData[0]["date"],2); ?></div></div><?php echo $articleData[0]["text"]; ?>

<?php include("include/zakladki.php"); ?> 

                        
<?php include("include/art.php"); ?> 
                    
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