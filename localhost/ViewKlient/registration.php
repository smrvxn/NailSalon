<?php

include_once '../config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styleKlients.css" type="text/css" />
	<title>Регистрация</title>
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
		<div class="main_reg" >
			<div class="container_reg">
				<div class="main_reg_text">
					<p>РЕГИСТРАЦИЯ</p>
				</div>
				<div class="input_cont_r">
                    <form action="registration.php" method="post" >
						<div class="input_cont_reg">
							<input autocomplete="off" class="input_text_reg" type="text" name="KlientName" placeholder="Имя" required>
							<input autocomplete="off" class="input_text_reg" type="text" name="Phone" placeholder="Номер телефона" required>
						</div>
						<div class="input_cont_reg">
							<input autocomplete="off" class="input_text_reg" type="email" name="Email" placeholder="Электронная почта" required>
							<input autocomplete="off" class="input_text_reg" type="date" name="Birth" placeholder="Дата рождения" required>
						</div>
						<div class="input_cont_reg">
							<input autocomplete="off" class="input_text_reg" type="password" name="Password" placeholder="Пароль" required>
							<input autocomplete="off" class="input_text_reg" type="password" name="Password_repeat" placeholder="Повторите пароль" required>
						</div>
						<input type="submit" value="Зарегистрироваться" class="reg_button"></input>
					</form>

					<?php
						if ($_SERVER["REQUEST_METHOD"] == "POST") {

						    $KlientName = $_POST['KlientName'];
							$Phone = $_POST['Phone'];
							$Email = $_POST['Email'];
							$Birth = $_POST['Birth'];
							$Password = $_POST['Password'];
							$Password_repeat = $_POST['Password_repeat'];

							if (empty($KlientName) || empty($Phone) || empty($Email) || empty($Birth) || empty($Password) || empty($Password_repeat)) {
        						echo "<p class='errorText'>Пожалуйста, заполните все поля!</p>";
        					} else {

        						if(strlen($Password) < 8)
        						{
        							echo "<p class='errorText'>Пароль должен быть не менее 8 символов!</p>";
        						} else {

        							if(!preg_match("/^(\+7|8)[0-9]{10}$/", $Phone))
        							{
        								echo "<p class='errorText'>Номер телефона набран некорректно!</p>";
        							} else {

        								if(!filter_var($Email, FILTER_VALIDATE_EMAIL) || strlen($Email) < 10)
        								{
        									echo "<p class='errorText'>Адрес электронной почты набран некорректно!</p>";
        								} else {

        									if($Password != $Password_repeat)
        									{
        										echo "<p class='errorText'>Пароли не совпадают!</p>";
        									} else {
        										$hashed_password = password_hash($Password, PASSWORD_DEFAULT);

											    $sql = "INSERT INTO Klient (KlientName, Phone, Email, Birthday, Password) VALUES (?, ?, ?, ?, ?)";
											    $stmt = $conn->prepare($sql);
											    $stmt->bind_param("sssss", $KlientName, $Phone, $Email, $Birth, $hashed_password);

											    if ($stmt->execute()) {

											        header('Location: login.php');

											    } else {
											        echo "Ошибка при регистрации: " . $stmt->error;
											    }

												$stmt->close();
												$conn->close();
        									}
        								}
        							}
        						}
        					}
						}
					?>
				</div>
			</div>
		</div>
	</main>

</body>
</html>