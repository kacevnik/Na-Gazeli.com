<div class="body3"></div>
<?php    
    happy_new_year();   
?>
<div class="body1">
	<div class="main">
<!-- header -->
		<header>
			<div id="logo_box">
				<h1><a href="index.php" id="logo" title="Заказ Газели">Na-Gazeli.com <span>Заказ Газели по Москве и МО</span> <?php echo $phone; ?></a></h1>
                <div class="user_nav">
                    <?php if(!$_SESSION["admin"]){ ?>
                    <a href="login.php">Вход</a>
                    <a href="rabota-na-gazeli.php">Регистрация</a>
                    <?php }else{ ?>
                    <a href="lk.php">Личный кабинет</a>
                    <a href="logout.php">Выход</a>
                    <?php } ?>
                </div>
			</div>
			<nav>
				<ul id="menu">
					<li <?php if($stranica == 1){echo "id='menu_active'";} ?>><a href="index.php">Главная</a></li>
					<li <?php if($stranica == 2){echo "id='menu_active'";} ?>><a href="article.php">Статьи</a></li>
					<li <?php if($stranica == 1){echo "id='menu_active'";} ?>><a href="drivers.php">Частники</a></li>
					<li <?php if($stranica == 4){echo "id='menu_active'";} ?>class="bg_none"><a href="/rabota-na-gazeli.php">Сотрудничество</a></li>
				</ul>
			</nav>
			<div class="wrapper">
<?php 
    if (isset($_GET['text']))       {$text = $_GET['text']; $text = trim(stripslashes(htmlspecialchars($text)));}
    if($text){
?>
				<div class="text1" style="width: 528px; text-align: center; font-size: 35px; height: 96px;"><?php echo $text; ?></div>
<?php        
    }
    else{
?>
				<div class="text1">Вам нужно быстро и надёжно доставить груз?</div>
				<div class="text2">Мы делаем это!</div>
<?php } ?>
			</div>
		</header>
<!-- / header -->
	</div>
</div>