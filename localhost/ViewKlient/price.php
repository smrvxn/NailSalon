<?php

	session_start();

	include "../config.php";

	$result = mysqli_query($conn, "select * from Services")

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styleKlients.css" type="text/css" />
	<title>Прайс-лист</title>
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

	<main class="price_main">
		<div class="price_container">
			<div class="price_head_text">
				<p class="price_head_text1">MANICURE</p>
				<p class="price_head_text2">price list</p>
				<img class="price_line" src="../images/line.png">
			</div>

			<div class="price_body">
				<?php
					while($pricedb = mysqli_fetch_assoc($result))
					{
				?>
				<div class="price_display">

					<div class="price_name_text">
						<p><?php echo $pricedb['Name']?></p>
					</div>

					<div class="price_price_text">
						<p><?php echo $pricedb['Price']?></p>
					</div>

				</div>
				<?php
					}
				?>
				<div class="price_text1">
					<p class="price_text11"><b>ТОП-Мастер +100р к ценнику</b></p>
					<p class="price_text11"><b>ПРЕМИУМ-Мастер +100р к ценнику</b></p>
					<br/>
					<p class="price_text2">*вид маникюра (аппаратный / классический / комбинированный) подбирает мастер под индивидуальные особенности ваших ручек</p>
					<p class="price_text2">*снятие с последующей процедурой бесплатно</p>
				</div>

			</div>

		</div>



	</main>
</body>
</html>

