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
<title>�������</title>
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
						<h2>������ �� "������" � ���������.</h2><br>
						�� ������ ������� ������� ����������� ����� �� ������ ������ � ��������� �� <b>2 ����</b> ������ ���� <b>1 ���</b> �� ������ ���������� � ����� ��������. ��������� � �������� ����� ������������ ����. �� ���� �������� ��������� � ����������: <b><?php echo $phone; ?></b>					
						<table width="572" class="main_table" style="margin-top:25px">
						  <tr class="main_table">
						    <td width="79" class="main_table_blue">����</td>
						    <td width="93" class="main_table_blue">�����</td>
						    <td width="93" class="main_table_blue">������</td>
						    <td width="93" class="main_table_blue">���������</td>
						    <td width="93" class="main_table_blue">�����. ���</td>
						    <td width="93" class="main_table_blue">1�� �� ����</td>
					      </tr>
						  <tr class="main_table">
						    <td rowspan="3" class="main_table_img"><img src="images/gazel_tent.png" title="������-���� �����: 3�. ������: 1.9� ������: 1.65�" width="78" height="78"></td>
						    <td class="main_table">1.5�-9���</td>
						    <td class="main_table">1+2</td>
						    <td class="main_table">1200 ���.</td>
						    <td class="main_table">400 ���.</td>
						    <td class="main_table">11 ���/��</td>
					      </tr>
						  <tr class="main_table">
						    <td class="main_table">1.5�-9���</td>
						    <td class="main_table">������ ���</td>
						    <td class="main_table">1350 ���.</td>
						    <td class="main_table">450 ���.</td>
						    <td class="main_table">11 ���/��</td>
					      </tr>
						  <tr class="main_table">
						    <td class="main_table">1.5�-9���</td>
						    <td class="main_table">������ ��</td>
						    <td class="main_table">1350 ���.</td>
						    <td class="main_table">450 ���.</td>
						    <td class="main_table">11 ���/��</td>
					      </tr>
						  <tr class="main_table">
						    <td rowspan="3" class="main_table_img"><img src="images/gazel_budka.png" title="������-���� �����: 3�. ������: 1.9� ������: 1.65-2.15�" width="78" height="78"></td>
							<td class="main_table">1.5�-9���</td>
						    <td class="main_table">1+2</td>
						    <td class="main_table">1200 ���.</td>
						    <td class="main_table">400 ���.</td>
						    <td class="main_table">11 ���/��</td>
					      </tr>
						  <tr class="main_table">
						    <td class="main_table">1.5�-9���</td>
						    <td class="main_table">������ ���</td>
						    <td class="main_table">1350 ���.</td>
						    <td class="main_table">450 ���.</td>
						    <td class="main_table">11 ���/��</td>
					      </tr>
						  <tr class="main_table">
						    <td class="main_table">1.5�-9���</td>
						    <td class="main_table">������ ��</td>
						    <td class="main_table">1350 ���.</td>
						    <td class="main_table">450 ���.</td>
						    <td class="main_table">11 ���/��</td>
					      </tr>
						  <tr class="main_table">
						    <td rowspan="3" class="main_table_img"><img src="images/gazel_tent_udlin.png" title="������-���� �����: 4�. ������: 1.95� ������: 2.2�" width="78" height="78"></td>
						    <td class="main_table">2�-17���</td>
						    <td class="main_table">1+2</td>
						    <td class="main_table">1350 ���.</td>
						    <td class="main_table">450 ���.</td>
						    <td class="main_table">13 ���/��</td>
					      </tr>
						  <tr class="main_table">
						    <td class="main_table">2�-17���</td>
						    <td class="main_table">������ ���</td>
						    <td class="main_table">1410 ���.</td>
						    <td class="main_table">470 ���.</td>
						    <td class="main_table">13 ���/��</td>
					      </tr>
						  <tr class="main_table">
						    <td class="main_table">2�-17���</td>
						    <td class="main_table">������ ��</td>
						    <td class="main_table">1500 ���.</td>
						    <td class="main_table">500 ���.</td>
						    <td class="main_table">13 ���/��</td>
					      </tr>
						  <tr class="main_table">
						    <td rowspan="3" class="main_table_img"><img src="images/gazel_budka_udlin.png" title="������-���� �����: 4�. ������: 1.95� ������: 2.2�" width="78" height="78"></td>
						    <td class="main_table">2�-17���</td>
						    <td class="main_table">1+2</td>
						    <td class="main_table">1350 ���.</td>
						    <td class="main_table">450 ���.</td>
						    <td class="main_table">13 ���/��</td>
					      </tr>
						  <tr class="main_table">
						    <td class="main_table">2�-17���</td>
						    <td class="main_table">������ ���</td>
						    <td class="main_table">1410 ���.</td>
						    <td class="main_table">470 ���.</td>
						    <td class="main_table">13 ���/��</td>
					      </tr>
						  <tr class="main_table">
						    <td class="main_table">2�-17���</td>
						    <td class="main_table">������ ��</td>
						    <td class="main_table">1500 ���.</td>
						    <td class="main_table">500 ���.</td>
						    <td class="main_table">13 ���/��</td>
					      </tr>
					  </table><p></p>
						<img src="images/left.png" alt="" class="left marg_right2" width="30" height="30"><p>���� ��� ������ ��������� �������� � �������, �� ������ ��������������� ������������� ��� ��������������� �������� ���� �� ������ ������.</p>
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