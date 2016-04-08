<?php 
	include("include/db.php");

	$stranica = 1;
    
    $resDrive = selDriver(time(), 0, 0);
    $avtoList = selAvto();
    $localList = selLocation();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="keywords" content="газель с водителем, частники на газели, база частинков" />
<title>Na-gazeli.com - База частников со своим автостранспотом</title>
<meta name="description" content="База частников со своим автостранспотом" />
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
					<div class="pad" style="padding: 0;">
						<h2>База частных водителей<a href="rabota-na-gazeli.php" class="button" style="float: right;"><span><span style="margin: -16px 0 0 0;">Добавить анкету сюда</span></span></a></h2><br/>
                        <div class="filter">
                            <form name="filter">
                                <select name="avto" class="select" size="1" style="width: 229px;" id="filter_avto">
    									<option selected="selected" value="0">Выберите тип транспорта</option>
    <?php foreach($avtoList as $key => $v){ ?>
    									<option value="<?php echo $key; ?>"><?php echo $v; ?></option>
    
    <?php } ?>                  									
    							</select>
                                <select name="local" class="select" size="1" style="width: 330px;" id="filter_local">
									<option selected="selected" value="0">Выбор района</option>
<?php foreach($localList as $keyl => $vl){ ?>
									<option value="<?php echo $keyl; ?>"><?php echo $vl; ?></option>

<?php } ?>                  									
                                </select>
                            </form>
                        </div>                        
<?php if($resDrive){ ?>	
                        <div id="filter_res">
                        <span class="filter_count" title="Всего анкет"><?php echo $resDrive[0]; ?></span>			
                            <ul class="drivers_list">
    <?php $count = 0; foreach($resDrive as $itenDriver){$count++; if($count == 1){continue;} ?>
                                <li>
                                    <img src="avatar/<?php if($itenDriver["avatar"] == ""){ ?>gazel_ico.png<?php }else{ echo $itenDriver["avatar"]; } ?>" title="" width="78" height="78"/>
                                    <div class="drivers_list_content">
                                        <div class="drivers_list_name"><?php echo $itenDriver["name"]; ?></div>
                                        <div class="drivers_list_avto"><?php echo $avtoList[$itenDriver["avto"]]; ?>.</div><div class="drivers_list_loc"><?php echo $localList[$itenDriver["raion"]]; ?></div>
                                        <div class="drivers_list_dis"><?php echo $itenDriver["dis"]; ?></div>
                                    </div>
                                    <div class="drivers_list_phone" id="n_phone_<?php echo $itenDriver["id"]; ?>"><a title="Показать номер" id="a_phone_<?php echo $itenDriver["id"]; ?>"><?php echo substr($itenDriver["phone"], 0, 8); ?> XXX-XX-XX</a></div>
                                </li>
    <?php } ?>                            
                            </ul>
                        </div>
<?php } ?>
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