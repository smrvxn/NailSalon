<?php

	include_once '../config.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styleKlients.css" type="text/css" />
	<title>Вход в аккаунт</title>
</head>
<body>
	<header class="head_main">
		<div class="text_head">
			<p><a href="main_page.php">MANICURE FOR YOU</a></p>
		</div>

		<div class="buttons_head">


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
							<li class="text_button_head"><a href="../ViewAdmin/loginAdmin.php">Администратор</a>
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
		<div class="main_log" >
			<div class="container_log">
				<div class="main_log_text">
					<p>ВХОД В АККАУНТ</p>
				</div>
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<div class="input_cont">
						<input class="input_text" type="text" name="Email" placeholder="Электронная почта" required>
						<input class="input_text" type="password" name="Password" placeholder="Пароль" required>
						<div class="login_text">
							<p>Еще нет аккаунта? <a href="registration.php"><b>Зарегистрируйтесь</b></a></p>
						</div>
						<input type="submit" name="submit" value="Войти" class="login_button"/>
					</div>
				</form>

				<?php

					if ($_SERVER['REQUEST_METHOD'] === 'POST') {
					    $Email = $_POST["Email"];
						$Password = $_POST["Password"];

						$sql = "SELECT * FROM Klient WHERE Email = ?";
						$stmt = $conn->prepare($sql);
						$stmt->bind_param("s", $Email);

						if ($stmt->execute()) {
							$result = $stmt->get_result();
							if ($result->num_rows > 0) {
								$row = $result->fetch_assoc();
								$hashed_password = $row["Password"];

								if (password_verify($Password, $hashed_password)) {

									session_start();
									$_SESSION["IdKlient"] = $row["IdKlient"];
									$_SESSION["KlientName"] = $row["KlientName"];
									$_SESSION["Email"] = $row["Email"];
									$_SESSION["Phone"] = $row["Phone"];
									$_SESSION["Birthday"] = $row["Birthday"];
									$_SESSION["Password"] = $row["Password"];

								} else {
									echo "<p class='errorText'>Неправильно набран пароль!</p>";
								}
							} else {
								echo "<p class='errorText'>Такого пользователя не существует!</p>";
							}
						} else {
							echo "<p class='errorText'>Ошибка при авторизации: </p>" . $stmt->error;
						}

						$stmt->close();
						$conn->close();

						if (isset($_SESSION["IdKlient"]))
						{
							header('Location: main_page.php');
							exit();
						}
					}
				?>
			</div>
		</div>
	</main>



</body>
</html>