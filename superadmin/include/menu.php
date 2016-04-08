
<div class="body3"></div>
<div class="body1">
	<div class="main">
<!-- header -->
		<header>
			<div id="logo_box">
				<h1><a href="index.php" id="logo"><?php echo $nameSite; ?> <span>Грузоперевозки по Москве и МО</span> <?php echo $phone; ?></a></h1>
			</div>
			<nav>
				<ul id="menu">
					<li <?php if($stranica == 1){echo "id='menu_active'";} ?>><a href="index.php">Заказы</a></li>
					<li <?php if($stranica == 2){echo "id='menu_active'";} ?>><a href="stati-page-1.php">Статьи</a></li>
					<li><a href="">Контакты</a></li>
					<li <?php if($stranica == 4){echo "id='menu_active'";} ?>class="bg_none"><a href="/rabota-na-gazeli.php">Сотрудничество</a></li>
				</ul>
			</nav>

		</header>
<!-- / header -->
	</div>
</div>