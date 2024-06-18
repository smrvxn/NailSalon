<?php

include_once '../config.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styleManager.css" type="text/css" />
	<title>login Manager</title>
</head>
<body>
	<header class="head_main">
		<div class="text_head">
			<p><a href="main_page.php">MANICURE FOR YOU</a></p>
		</div>
	</header>

	<main>
		<div class="main_log" >
			<div class="container_log_m">
                <p class="main_log_text">ВХОД УПРАВЛЯЮЩЕГО</p>
				<form method="POST">
					<div class="input_cont_m">
						<input class="input_text_m" type="text" name="Login" placeholder="Логин">
						<input class="input_text_m" type="password" name="Password" placeholder="Пароль">
						<input type="submit" name="submit" value="Войти" class="login_button_m"/>
					</div>
				</form>

                <?php

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Получение данных из формы
                        $Login = $_POST["Login"];
                        $Password = $_POST["Password"];

                        // Подготовка SQL-запроса
                        $sql = "SELECT * FROM Manager WHERE Login = ?";
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
                                    $_SESSION["IdManager"] = $row["IdManager"];
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

                    if (isset($_SESSION["IdManager"]))
                    {
                        header('Location: mainManager.php');
                        exit();
                    }
                ?>
			</div>
		</div>
	</main>
</body>
</html>