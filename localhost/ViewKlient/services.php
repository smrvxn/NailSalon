<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styleKlients.css" type="text/css" />
	<title>Услуги</title>
</head>
<body>
	<header class="head_main">
		<div class="text_head">
			<p><a href="main_page.php">MANICURE FOR YOU</a></p>
		</div>

		<div class="buttons_head">

			<a href="notifications/notification.php"><img class="notImg" src="../images/notification.png"></a>

			<?php

			// Проверка, активна ли сессия
			if (isset($_SESSION["IdKlient"])) {
			    // Пользователь авторизован, выводим кнопку "Выйти"
			    echo '<button class="button1_head"><a href="KlientAccount/accountMain.php">Аккаунт</a></button>';
			} else {
			    // Пользователь не авторизован, выводим кнопку "Авторизация"
			    echo '<button class="button1_head"><a href="login.php">Войти</a></button>';
			}

			?>

			<div class="button2_head">
				<ul class="head_menu">
					<li class="text_button_head"><a href="main_page.php">Меню</a>
						<ul >
							<li class="text_button_head"><a href="about_we.php">О нас</a></li>
							<li class="text_button_head"><a href="services.php">Услуги</a></li>
							<li class="text_button_head"><a href="price.php">Прайс</a></li>
							<li class="text_button_head"><a href="commands.php">Команда</a></li>
							<li class="text_button_head"><a href="worksPage.php">Работы</a></li>
							<?php
								if (isset($_SESSION["IdKlient"])) {
								    echo '<li class="text_button_head"><a href="requareKlient.php">Запись онлайн</a></li>';
								}
							?>

						</ul>
					</li>
				</ul>
			</div>
		</div>
	</header>

	<main>
		<div class="main_services" >
			<div class="menu_services">
				<div class="fon_services">
					<img class="services_img" src="../images/serv1.png">
					<p class="services_text1">Маникюр</p>
					<p class="services_text2">комплексная процедура, которая <br>включает в себя гигиеническую<br> обработку, работы по приданию <br>формы и обработки краёв</p>
				</div>
				<div class="fon_services">
					<img class="services_img" src="../images/serv2.png">
					<p class="services_text1">Гель-лак</p>
					<p class="services_text2">это стойкое декоративное <br>покрытие для ногтей, которое <br>корректирует форму ногтевой <br>пластины</p>
				</div>
				<div class="fon_services">
					<img class="services_img" src="../images/serv3.png">
					<p class="services_text1">Укрепление</p>
					<p class="services_text2">ногтей перед нанесением <br>гель-лака позволяет сделать <br>их прочными и менее гибкими, <br>что повышает стойкость гель-лака</p>
				</div>
				<div class="fon_services">
					<img class="services_img" src="../images/serv4.png">
					<p class="services_text1">Ремонт</p>
					<p class="services_text2">трещина заполняется полигелем <br>для дальнейшего покрытия гелем, <br>это позволяет оставить желаемую <br>форму ногтя после повреждения</p>
				</div>
				<div class="fon_services">
					<img class="services_img" src="../images/serv5.png">
					<p class="services_text1">Наращивание</p>
					<p class="services_text2"><br>это выстроение желаемой <br>длинны ноготка полигелем</p>
				</div>
				<div class="fon_services">
					<img class="services_img" src="../images/serv6.png">
					<p class="services_text1">Снятие</p>
					<p class="services_text2">процесс, во время котого <br>материал с ногтя снимается <br>с помощью фрезы <br>маникюрного аппарата</p>
				</div>
			</div>

		</div>
	</main>

	<footer>

	</footer>
</body>
</html>