<?php
session_start();
if(empty($_SESSION['IdManager']))
{
    header('Location: loginManager.php');
    exit;
}

	include_once '../config.php';

	$result = mysqli_query($conn, "select * from Admin");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styleManager.css" type="text/css" />
	<title>Manager Main</title>
</head>
<body>
	<header class="head_main">
		<div class="text_head">
			<p>MANICURE FOR YOU</p>
		</div>
		<div class="buttons_head">
			<button class="button12_head"><a href="">Просмотр администраторов</a></button>
			<button class="button12_head"><a href="mainManager2.php">Просмотр посещаемости</a></button>
			<button class="button1_head"><a href="logoutManager.php">Выйти</a></button>

		</div>
	</header>

	<main>
		<div class="manager_main">
			<div class="manager_main_container">
				<a href="updAdmin/adminAdd.php" ><input type="submit" class="button_addAdmin" value="Добавить администратора"></input></a>

				<?php while($adm = mysqli_fetch_assoc($result)) { ?>

					<form>
						<div class="cont_adm">
							<p class="text_adm"><?=$adm['FIO']?></p>
							<p class="text_adm"><?=$adm['Phone']?></p>
							<p class="text_adm"><?=$adm['Login']?></p>

							<div class="upd_button">
								<button class="upd_button1"><a class="upd_button1_a" href="updAdmin/updateAdmin.php?id=<?= $adm['IdAdmin'] ?>">Изменить</a></button>
								<button  class="upd_button1"><a class="upd_button1_a" href="updAdmin/deleteAdmin.php?id=<?= $adm['IdAdmin'] ?>">Удалить</a></button>
							</div>

						</div>
					</form>
				<?php
					}
				?>
			</div>
		</div>
	</main>
</body>
</html>