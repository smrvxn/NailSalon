<?php

	session_start();
    if(empty($_SESSION['IdAdmin']))
    {
        header('Location: ../loginAdmin.php');
        exit;
    }

	include "../../config.php";

	$result = mysqli_query($conn, "select * from Services")

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../styleAdmin.css" type="text/css" />
	<title>Manicure For You</title>
</head>
<body>
	<header class="head_main">
		<div class="text_head">
			<p><a href="main_page.php">MANICURE FOR YOU</a></p>

		</div>
	</header>

	<main>
		<div class="updatePriceMain">
			<div class="updatePriceContainer">
				<?php
					while($pricedb = mysqli_fetch_assoc($result))
					{
				?>
				<div class="priceBody">

					<form method="post" action="updatePriceScrips.php">
						<input type="hidden" name="IdServices" value="<?= $pricedb['IdServices']?>"/>
						<input class="priceTextUpd" name="Name" type="text" value="<?= $pricedb['Name']?>"/>
						<input class="priceCountUpd" name="Price" type="text" value="<?= $pricedb['Price']?>"/>

						<button  class="buttonSavePrice">Сохранить</button>
					</form>

					<form method="post" action="deletePrice.php">
						<input type="hidden" name="IdServices" value="<?= $pricedb['IdServices']?>"/>
						<button  class="buttonSavePrice1">Удалить</button>
					</form>

				</div>
				<?php
					}
				?>
			</div>
			<form method="post" action="addPrice.php">
				<div class="addPriceContainer">
					<input type="text" name="Name" class="addPriceInput" placeholder="Название"/>
					<input type="text" name="Price" class="addPriceInput" placeholder="Цена"/>
					<a href=""><button class="addPriceButton">Добавить услугу</button></a>
				</div>
			</form>
		</div>
	</main>

</body>
</html>