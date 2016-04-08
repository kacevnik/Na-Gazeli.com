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

?>
<!DOCTYPE html>
<html>
<head>
<meta name="keywords" content="<?php echo $myrMain[keywords]; ?>" />
<title><?php echo $nameSite." - Заказ газели, заказать газель грузоперевозки по Москве"; ?></title>
<meta name="description" content="<?php echo $myrMain[disc]; ?>" />
<meta charset="utf-8"/><link rel="icon" href="http://gazel/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="http://gazel/favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all"/>
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all"/>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all"/>
<script type="text/javascript" src="scripts/jquery.js"></script>
<!--[if lt IE 9]>
	<script type="text/javascript" src="http://info.template-help.com/files/ie6_warning/ie6_script_other.js"></script>
	<script type="text/javascript" src="js/html5.js"></script>
<![endif]-->
  <script type="text/javascript">
	$(document).ready(function(){
		$(".question").toggle(function(){
			$(this).next().slideDown();
		}, function(){
			$(this).next().slideUp();
		});
	});
  </script>
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
                   <h2>Заказы</h2><br/>
                   <table width="572" style="margin-top:15px">
						  <tr class="main_table">
						    <td width="37" class="main_table_blue">№</td>
						    <td width="93" class="main_table_blue">Дата</td>
						    <td width="113" class="main_table_blue">Водитель</td>
						    <td width="93" class="main_table_blue">Газель</td>
						    <td width="93" class="main_table_blue">Сумма</td>
						    <td width="93" class="main_table_blue">Оплачено</td>
					      </tr>
                          <?php 
                            $result77 = mysql_query("SELECT content FROM setings WHERE name='str'", $db);
                            $myrow77 = mysql_fetch_array($result77);
                            $num = $myrow77["content"];

                            @$page = $_GET['page'];

                            $rezultTemp = mysql_query("SELECT COUNT(*) FROM zakaz",$db);
                            $temp = mysql_fetch_array($rezultTemp);
                            $posts = $temp[0];

                            $total = (($posts - 1) / $num) + 1;
                            $total =  intval($total);

                            $page = intval($page);

                            if(empty($page) or $page < 0) $page = 1;
                            if($page > $total) $page = $total;

                            $start = $page * $num - $num;
                            
                            $resZakaz = mysql_query("SELECT * FROM zakaz ORDER BY data DESC LIMIT $start, $num",$db);
                            $myrZakaz = mysql_fetch_array($resZakaz);
                            $a = 0;
                            do{
                                $dataZakaz = data_one($myrZakaz["data"],2);
                                if($myrZakaz["data"] == $data){$dataZakaz = "Сегодня";}
                                $a = $a + 1;
                                
                                $voditelId = $myrZakaz["voditel"];
                                $procentSum = $myrZakaz["procent"];
                                
                                if($myrZakaz["oplaceno"] == 0){
                                    $procent = $procentSum;
                                }
                                else{
                                    $procent = "Оплачено";
                                }
                                
                                $resVoditel = mysql_query("SELECT * FROM voditel WHERE id='$voditelId'",$db);
                                $myrVoditel = mysql_fetch_array($resVoditel);
                                $nameVoditel = $myrVoditel["name"];
                                
                                printf("<tr>
						    <td width='37' class='main_table'>%s</td>
						    <td width='93' class='main_table'><a href='zakaz.php?id=%s'>%s</a></td>
						    <td width='113' class='main_table'><a href='voditel.php?id=%s'>%s</a></td>
						    <td width='93' class='main_table'>%s</td>
                            <td width='93' class='main_table'>%s</td>
						    <td width='93' class='main_table'>%s</td>
						    
					      </tr>

                            ", $a, $myrZakaz["id"], $dataZakaz, $voditelId, $nameVoditel, $myrZakaz["avto"], $myrZakaz["summa"], $procent);
                            }
                            while($myrZakaz = mysql_fetch_array($resZakaz));

                          ?>
						  
					  </table>
                      <?php
                            if ($page != 1) $pervpage = '<a href=index.php?page=1>Первая</a> | <a href=index.php?page='. ($page - 1) .'>Предыдущая</a> | ';

                            if ($page != $total) $nextpage = ' | <a href=index.php?page='. ($page + 1) .'>Следующая</a> | <a href=index.php?page=' .$total. '>Последняя</a>';

                            if($page - 5 > 0) $page5left = ' <a href=index.php?page='. ($page - 5) .'>'. ($page - 5) .'</a> | ';
                            if($page - 4 > 0) $page4left = ' <a href=index.php?page='. ($page - 4) .'>'. ($page - 4) .'</a> | ';
                            if($page - 3 > 0) $page3left = ' <a href=index.php?page='. ($page - 3) .'>'. ($page - 3) .'</a> | ';
                            if($page - 2 > 0) $page2left = ' <a href=index.php?page='. ($page - 2) .'>'. ($page - 2) .'</a> | ';
                            if($page - 1 > 0) $page1left = '<a href=index.php?page='. ($page - 1) .'>'. ($page - 1) .'</a> | ';

                            if($page + 5 <= $total) $page5right = ' | <a href=index.php?page='. ($page + 5) .'>'. ($page + 5) .'</a>';
                            if($page + 4 <= $total) $page4right = ' | <a href=index.php?page='. ($page + 4) .'>'. ($page + 4) .'</a>';
                            if($page + 3 <= $total) $page3right = ' | <a href=index.php?page='. ($page + 3) .'>'. ($page + 3) .'</a>';
                            if($page + 2 <= $total) $page2right = ' | <a href=index.php?page='. ($page + 2) .'>'. ($page + 2) .'</a>';
                            if($page + 1 <= $total) $page1right = ' | <a href=index.php?page='. ($page + 1) .'>'. ($page + 1) .'</a>';

                            if ($total > 1)
{
Error_Reporting(E_ALL & ~E_NOTICE);
echo "<div style='margin-top:20px; text-align: center'>";
echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$page3right.$page4right.$page5right.$nextpage;
echo "</div>";
}
?>
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