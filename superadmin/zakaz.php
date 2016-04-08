<?php 
    include("include/function.php");
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
	
	$resMain = mysql_query("SELECT * FROM material WHERE id='1'",$db);
	$myrMain = mysql_fetch_array($resMain);

	$stranica = 1;
    $data = date("Y-m-d");
    
    if (isset($_GET['id'])){$id = $_GET['id'];}
    
    if($id){
   	    $resZakaz = mysql_query("SELECT * FROM zakaz WHERE id='$id'",$db);
        $myrZakaz = mysql_fetch_array($resZakaz);
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Заказ № <?php echo $myrZakaz["id"]; ?></title>
<meta charset="utf-8"/><link rel="icon" href="http://gazel/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="http://gazel/favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all"/>
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all"/>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all"/>
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
			<div class="wrapper marg_top2">
				<article class="col1">
					<div class="box2">
                            <?php include("include/dop_left.php"); ?>
                            
                    </div>
				</article>
				<article class="col2 pad_left1">
				<div class="pad">
                   <h2>Заказ: id <?php echo $myrZakaz["id"]; ?></h2><br/>
                   
                </div>
            </div>
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