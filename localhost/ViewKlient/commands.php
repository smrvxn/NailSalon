<?php
	session_start();

	include "../config.php";

	$query = "  SELECT
					m.FIO,
					m.Qualification,
					m.WorkExperience,
					m.Information,
					m.Image,
					AVG(f.MasterFeetback) AS average_rating
				FROM Feedback f
				JOIN KlientRequest kr ON f.IdRequest = kr.IdRequest
				JOIN Master m ON kr.IdMaster = m.IdMaster
				GROUP BY m.IdMaster";

	$result = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styleKlients.css" type="text/css" />
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<title>Команда</title>
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

	<main class="main_commands">


		<div class="container_commands">
			<?php

				while($masters = mysqli_fetch_assoc($result)) { ?>
				<div class="container_people">
				<img class="peop_photo" src="../images/people/<?php echo $masters['Image']?>"/>
				<div class="peop_text">
					<p class="peop_name"><?php echo $masters['FIO']?></p>
					<p class="peop_kval"><?php echo $masters['Qualification']?></p>
					<p class="peop_stazh">Стаж работы: <?php echo $masters['WorkExperience']?></p>
					<p class="peop_desc"><?php echo $masters['Information']?></p>
				</div>
				<p class="masterReyting"><?php echo number_format($masters['average_rating'], 2); ?></p>
				<i class="fa fa-star fa-2x" id="starComm" ></i>
				</div>
			<?php
			}
			?>
		</div>

	</main>
</body>
</html>