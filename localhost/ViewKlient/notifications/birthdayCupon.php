<?php

// Подключение к базе данных
include_once '../../config.php';

session_start();

$nameKlient = $_SESSION['KlientName'];
if(empty($_SESSION['IdKlient']))
{
    header('Location: ../login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../styleKlients.css" type="text/css" />
		<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
		<title>Manicure for you</title>
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
				    echo '<button class="button1_head"><a href="../KlientAccount/accountMain.php">Аккаунт</a></button>';
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
									    echo '<li class="text_button_head"><a href="../requareKlient/requareKlient.php">Запись онлайн</a></li>';
									}
								?>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</header>

		<main>
			<div class="feedKlientMain">
				<div class="feedKlientContainer">
					<p class='feedKlientText'>С днем рождения!</p>

					<div class="RowContainer1">
						<div class="TextKuponDiv">
							<p class="TextKupon">Уважаемая <?= $nameKlient ?>, от всей команды хотим поздравить вас с днем рождения и подарить купон на скидку на следующее посещение.</p>
						</div>

						<img class="imgKupon" src="../../images/saleKupon.png">
					</div>

				</div>
			</div>
		</main>


	</body>
</html>