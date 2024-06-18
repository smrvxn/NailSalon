<?php

	session_start();

	if (isset($_SESSION['IdKlient'])) {

	    $user_id = $_SESSION['IdKlient'];
	    $user_name = $_SESSION['KlientName'];
	    $user_birth = $_SESSION['Birthday'];
	    $user_email = $_SESSION['Email'];
	    $user_phone = $_SESSION['Phone'];


	} else {
	    // Если пользователь не авторизован, перенаправление на страницу входа
	    header("Location: ../login.php");
	    exit;
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../styleKlients.css">
	<title>Manicure For You</title>
</head>
<body>
	<header class="head_main">
		<div class="text_head">
			<p><a href="../main_page.php">MANICURE FOR YOU</a></p>
		</div>

		<div class="buttons_head">

			<a href="notification.php"><img class="notImg" src="../../images/notification.png"></a>

			<?php

			// Проверка, активна ли сессия
			if (isset($_SESSION["IdKlient"])) {
			    // Пользователь авторизован, выводим кнопку "Выйти"
			    echo '<button class="button1_head"><a href="accountMain.php">Аккаунт</a></button>';
			} else {
			    // Пользователь не авторизован, выводим кнопку "Авторизация"
			    echo '<button class="button1_head"><a href="../login.php">Войти</a></button>';
			}

			?>

			<div class="button2_head">
				<ul class="head_menu">
					<li class="text_button_head"><a href="">Меню</a>
						<ul >
							<li class="text_button_head"><a href="../about_we.php">О нас</a></li>
							<li class="text_button_head"><a href="../services.php">Услуги</a></li>
							<li class="text_button_head"><a href="../price.php">Прайс</a></li>
							<li class="text_button_head"><a href="../commands.php">Команда</a></li>
							<li class="text_button_head"><a href="../worksPage.php">Работы</a></li>
							<?php
								if (isset($_SESSION["IdKlient"])) {
								    echo '<li class="text_button_head"><a href="../requareKlient.php">Запись онлайн</a></li>';
								}
							?>

						</ul>
					</li>
				</ul>
			</div>
		</div>
	</header>

	<main>
		<div class="accountMain">
			<div class="accountContainer">
				<p class="accountText">АККАУНТ ПОЛЬЗОВАТЕЛЯ</p>
				<div class="accountContainer2">
					<div class="accountHeader">
						<p class="accountText2">Имя:</p>
						<p class="accountText2">Дата рождения:</p>
						<p class="accountText2">Номер тел:</p>
						<p class="accountText2">Эл. почта:</p>
					</div>
					<div class="accountData">
						<p class="accountText2"><?= $user_name ?></p>
						<p class="accountText2"><?= $user_birth ?></p>
						<p class="accountText2"><?= $user_phone ?></p>
						<p class="accountText2"><?= $user_email ?></p>
					</div>
				</div>
				<button class="accountButons"><a href="accountUpdate.php">Изменить данные</a></button>
				<button class="accountButons2"><a href="../logout.php">Выйти</a></button>
			</div>
		</div>
	</main>
</body>
</html>