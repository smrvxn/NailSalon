<?php
session_start();

if(empty($_SESSION['IdKlient']))
{
    header('Location: ../login.php');
    exit;
}
// Получаем IdKlient из сессии
$idKlient = $_SESSION['IdKlient'];

// Подключение к базе данных
include_once '../../config.php';

// Запрос для получения последних 3 уведомлений
$sql = "SELECT NotifText, IdRequest, UrlForKlient
        FROM Notification
        WHERE IdKlient = $idKlient
        ORDER BY Id DESC
        LIMIT 3";

$result = $conn->query($sql);



$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../styleKlients.css" type="text/css" />
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
		<div class="notifKlientMain">
			<div class="notifKlientContainer">

				<?php if ($result->num_rows > 0) { ?>
				    <p class="notifKlientText">УВЕДОМЛЕНИЯ</p>
				    <?php while($row = $result->fetch_assoc()) { ?>
				    	<a href="<?= $row['UrlForKlient'] ?>" class=NotifTextContainer1><div class="NotifTextContainer">
				    		<img class="notifImage" src="../../images/notif.png">
				    		<p class="notifText"><?= $row["NotifText"] ?></p>
				    	</div></a>

				    <?php }
						} else {
					?>
				    <p class="notifKlientText">Нет новых уведомлений</p>
				<?php
					}
				?>

			</div>
		</div>
	</main>
</body>
</html>