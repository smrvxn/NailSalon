<?php

include_once '../config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styleAdmin.css" type="text/css" />
	<title>Вход в аккаунт</title>
</head>
<body>
	<header class="head_main">
		<div class="text_head">
			<p><a href="../ViewKlient/main_page.php">MANICURE FOR YOU</a></p>
		</div>

		<div class="buttons_head">
			<button class="button1_head"><a href="../ViewKlient/login.php">Войти</a></button>

			<div class="button2_head">
				<ul class="head_menu">
					<li class="text_button_head"><a href="">Меню</a>
						<ul >
							<li class="text_button_head"><a href="../ViewKlient/about_we.php">О нас</a></li>
							<li class="text_button_head"><a href="../ViewKlient/services.php">Услуги</a></li>
							<li class="text_button_head"><a href="../ViewKlient/price.php">Прайс</a></li>
							<li class="text_button_head"><a href="../ViewKlient/commands.php">Команда</a></li>
							<li class="text_button_head"><a href="../ViewKlient/worksPage.php">Работы</a></li>
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
					<p>ВХОД В АККАУНТ АДМИНИСТРАТОРА</p>
				</div>
				<form method="POST">
					<div class="input_cont">
						<input class="input_text" type="text" name="Login" placeholder="Логин">
						<input class="input_text" type="password" name="Password" placeholder="Пароль">
						<button class="login_button">ВОЙТИ</button>
					</div>
				</form>
				<?php

					if ($_SERVER["REQUEST_METHOD"] == "POST") {

					    $Login = $_POST["Login"];
					    $Password = $_POST["Password"];

					    // Подготовка SQL-запроса
					    $sql = "SELECT * FROM Admin WHERE Login = ?";
					    $stmt = $conn->prepare($sql);
					    $stmt->bind_param("s", $Login);

					    // Выполнение запроса
					    if ($stmt->execute()) {
					        $result = $stmt->get_result();
					        if ($result->num_rows > 0) {
					            $row = $result->fetch_assoc();
					            $hashed_password = $row["Password"];

					            // Проверка пароля
					            if (password_verify($Password, $hashed_password)) {
					                // Начало сессии и сохранение данных пользователя
					                session_start();
					                $_SESSION["IdAdmin"] = $row["IdAdmin"];
					                $_SESSION["FIO"] = $row["FIO"];
					                $_SESSION["Login"] = $row["Login"];

					                echo "Вы успешно авторизованы!";
					            } else {
					                echo "<p class='errorText'>Неправильный логин или пароль.</p>";
					            }
					        } else {
					            echo "<p class='errorText'>Неправильный логин или пароль.</p>";
					        }
					    } else {
					        echo "<p class='errorText'>Ошибка при авторизации: </p>" . $stmt->error;
					    }
					    $stmt->close();
					}
					$conn->close();

					if (isset($_SESSION["IdAdmin"]))
					{
						header('Location: mainAdmin.php');
						exit();
					}
				?>
			</div>
		</div>
	</main>

</body>
</html>