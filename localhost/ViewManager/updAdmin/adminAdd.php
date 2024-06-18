<?php
session_start();
if(empty($_SESSION['IdManager']))
{
    header('Location: loginManager.php');
    exit;
}

include_once '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $FIO = $_POST['FIO'];
	$Phone = $_POST['Phone'];
	$Login = $_POST['Login'];
	$Password = $_POST['Password'];

    $hashed_password = password_hash($Password, PASSWORD_DEFAULT);


    $sql = "INSERT INTO Admin (FIO, Phone, Login, Password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $FIO, $Phone, $Login, $hashed_password);

    // Выполнение запроса
    if ($stmt->execute()) {
        header('Location: ../mainManager.php');
		exit();

    } else {
        echo "Ошибка при добавлении: " . $stmt->error;
    }

    $stmt->close();
}
	$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../styleManager.css" type="text/css" />
	<title>Admin Add</title>
</head>
<body>
	<header class="head_main">
		<div class="text_head">
			<p>MANICURE FOR YOU</p>
		</div>
	</header>

	<main>
		<div class="main_reg" >
			<div class="container_reg">
				<div class="main_reg_text">
					<p>ДОБАВИТЬ АДМИНИСТРАТОРА</p>
				</div>
				<div class="input_cont_r">
                    <form method="post">
						<div class="input_cont_reg">
							<input autocomplete="off" class="addAdmin_input" type="text" name="FIO" placeholder="Имя">
							<input autocomplete="off" class="addAdmin_input" type="text" name="Phone" placeholder="Номер телефона">
						</div>
						<div class="input_cont_reg">
							<input autocomplete="off" class="addAdmin_input" type="text" name="Login" placeholder="Логин">
							<input autocomplete="off" class="addAdmin_input" type="text" name="Password" placeholder="Пароль">
						</div>
						<input type="submit" value="Добавить" class="reg_button"></input>
					</form>
				</div>
			</div>
		</div>
	</main>

</body>
</html>