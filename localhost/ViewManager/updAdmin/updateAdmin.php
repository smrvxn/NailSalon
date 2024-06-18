<?php

	include_once '../../config.php';

	$id = $_GET['id'];

	$admin = mysqli_query($conn, "SELECT * FROM Admin WHERE IdAdmin = '$id'");

	$admin = mysqli_fetch_assoc($admin);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../styleManager.css" type="text/css" />
	<title>Update Admin</title>
</head>
<body>
	<header class="head_main">
		<div class="text_head">
			<p><a href="main_page.php">MANICURE FOR YOU</a></p>
		</div>
	</header>

	<main>
		<div class="main_updAdmin" >
			<div class="container_updAdmin">
				<div class="dataUpdateAdmin">
					<p class="textUpdAdmin">Изменить данные</p>
					<form method="post" action="updateAdminScript.php">
						<input type="hidden" name="id" value="<?= $admin['IdAdmin']?>"/>
						<input type="text" name="FIO" class="inp_updAdm" value="<?= $admin['FIO']?>"/>
						<input type="text" name="Phone" class="inp_updAdm" value="<?= $admin['Phone']?>"/>
						<input type="text" name="Login" class="inp_updAdm" value="<?= $admin['Login']?>"/>
						<input type="hidden" name="Password" value="<?= $admin['Password']?>"/>
						<button class="updateAdmButton">Изменить</button>
					</form>
				</div>
				<div class="passwordUpdateAdmin">
					<p class="textUpdAdmin">Изменить пароль</p>
					<form method="post" action="updateAdminScript.php">
						<input type="hidden" name="id" value="<?= $admin['IdAdmin']?>"/>
						<input type="hidden" name="FIO" class="inp_updAdm" value="<?= $admin['FIO']?>"/>
						<input type="hidden" name="Phone" class="inp_updAdm" value="<?= $admin['Phone']?>"/>
						<input type="hidden" name="Login" class="inp_updAdm" value="<?= $admin['Login']?>"/>
						<input type="text" name="Password" class="inp_updAdm" placeholder="Введите новый пароль"/>
						<button class="updateAdmButton">Изменить</button>
					</form>
				</div>
			</div>
		</div>
	</main>
</body>
</html>