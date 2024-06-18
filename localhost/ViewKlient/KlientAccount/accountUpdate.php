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
				<p class="accountText">ИЗМЕНИТЬ ДАННЫЕ</p>

				<form action="updateScript.php" method="post" class="fromColumn">
					<div class="accountContainer2">
						<div class="accountHeader">
							<p class="accountText2">Имя:</p>
							<p class="accountText2">Дата рождения:</p>
							<p class="accountText2">Номер тел:</p>
							<p class="accountText2">Эл. почта:</p>
						</div>
						<div class="accountData">
							<input class="accountText3" type="hidden" name="id" value="<?= $user_id ?>"/>
							<input class="accountText3" type="text" name="name" value="<?= $user_name ?>"/>
							<input class="accountText3" type="text" name="birth" value="<?= $user_birth ?>"/>
							<input class="accountText3" type="text" name="phone" value="<?= $user_phone ?>"/>
							<input class="accountText3" type="text" name="email" value="<?= $user_email ?>"/>
						</div>
					</div>
					<p class="accountText4">Для того, чтобы изменения вступили в силу, перезайдите в аккаунт</p>
					<button class="accountButtons3">Изменить данные</button>
				</form>
			</div>
		</div>
	</main>
</body>
</html>