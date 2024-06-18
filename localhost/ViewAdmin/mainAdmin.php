<?php
session_start();
if(empty($_SESSION['IdAdmin']))
{
    header('Location: loginAdmin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styleAdmin.css" type="text/css" />
	<title>Admin Main</title>
</head>
<body>
	<header class="head_main">
		<div class="text_head">
			<p>MANICURE FOR YOU</p>
		</div>
		<div class="buttons_head">
			<button class="button1_head"><a href="logoutAdmin.php">Выйти</a></button>
		</div>
	</header>

	<main>
		<div class="manager_main">
			<div class="manager_main_container">
				<a href="updPrice/updatePrice.php" class="adminButtonUpdate">Изменить прайс-лист</a>
				<a href="updMaster/updateMaster.php" class="adminButtonUpdate">Изменить команду</a>
				<a href="updGraph/graphikForMaster.php" class="adminButtonUpdate">Составить график</a>
				<a href="confirmRequest/ConfRequest.php" class="adminButtonUpdate">Подтвердить запись</a>
				<a href="visitRequest/visitRequest.php" class="adminButtonUpdate">Отметить посещение</a>
				<a href="updPhoto/addPhoto.php" class="adminButtonUpdate">Пополнить портфолио</a>
				<button id="check-birthday"  class="adminButtonUpdate">Отправить купоны</button>
			</div>
			<script src="script.js"></script>
		</div>
	</main>
</body>
</html>