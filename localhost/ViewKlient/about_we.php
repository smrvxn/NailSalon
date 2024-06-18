<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styleKlients.css" type="text/css" />
	<title>О нас</title>
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

	<main class="about_we_main">
		<div class="about_container1">
			<img class="about_img1" src="../images/about1.png">
			<div class="about_text_div1">
				<p class="about_text1_div1">БОЛЕЕ</p>
				<p class="about_text2_div1">1000</p>
				<p class="about_text3_div1">ДОВОЛЬНЫХ КЛИЕНТОВ</p>
				<div class="about_text_div1_2">
					<p class="about_text1_div1">БОЛЕЕ</p>
					<p class="about_text2_div1">800</p>
					<p class="about_text3_div1">ПОЛОЖИТЕЛЬНЫХ</p>
					<p class="about_text3_div1">ОТЗЫВОВ</p>
				</div>
			</div>
		</div>

		<div class="about_container2">
			<div class="about_text_div2">
				<p class="about_text1_div2">КАК НАС НАЙТИ</p>
				<div class="about_text_div2_address">
					<p class="about_text2_div2">г. Екатеринбург, ул. Первомайская 15</p>
					<p class="about_text2_div2">офис 322</p>
				</div>
				<div class="about_text_div2_togo">
					<p class="about_text3_div2">По данному адресу находится бизнес-центр “Вознесенский”.</p>
					<p class="about_text3_div2">Нужно зайти в главный вход, подойти к посту охраны</p>
					<p class="about_text3_div2">и назвать номер офиса (322).</p>
					<p class="about_text3_div2">Для прохода Вам понадобится документ, удостоверяющий</p>
					<p class="about_text3_div2">личность (паспорт, вод. удостоверение и тд).</p>
					<p class="about_text3_div2">После прохождения КПП поднимайтесь на 3 этаж.</p>
					<p class="about_text3_div2">Выйдя из лифта поверните на право и двигайтесь прямо </p>
					<p class="about_text3_div2">по коридору.</p>
				</div>
			</div>

			<iframe class="maps" src="https://yandex.ru/map-widget/v1/?um=constructor%3A539267bbbce505c3373ad0e4a84b57e40a9d539981509978f47729bbb1d113d7&amp;source=constructor"></iframe>
		</div>

		<div class="about_container3">
			<img class="about_img2" src="../images/about6.png">
			<div class="about_text_div3">
				<p class="about_text1_div3">ГРАФИК РАБОТЫ</p>
				<p class="about_text2_div3">c 12:00 до 22:00</p>
				<p class="about_text3_div3">к а ж д ы й ㅤ д е н ь</p>
			</div>
		</div>

		<div class="about_container4">
			<div class="about_text_div4">
				<p class="about_text1_div4">КАК С НАМИ СВЯЗАТЬСЯ</p>

				<div class="about_text_div4_1">
					<p class="about_text2_div4"><a href="tel:+79920144939">8 (958) 655 11-35</a></p>
					<p class="about_text2_div4"><a href="mailto:manic_for_u@gmail.com">manic_for_u@gmail.com</a></p>
				</div>

				<div class="soc_seti_about">
					<a href="https://t.me/+79920144939"><img class="soc_seti_about_img" src="../images/tg.png"></a>
					<a href="https://wa.me/89920144939?text=%D0%9F%D1%80%D0%B8%D0%B2%D0%B5%D1%82!%20%F0%9F%91%8B%20%D0%9C%D0%B5%D0%BD%D1%8F%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%B5%D1%81%D1%83%D0%B5%D1%82..."><img class="soc_seti_about_img" src="../images/wa.png"></a>
					<a href="https://vk.com/smrwxn"><img class="soc_seti_about_img" src="../images/vk.png"></a>
				</div>
			</div>
			<img class="about_img3" src="../images/about7.png">
		</div>
	</main>

</body>
</html>