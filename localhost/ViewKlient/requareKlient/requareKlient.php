<?php

session_start();

if(empty($_SESSION['IdKlient']))
{
    header('Location: ../login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../styleKlients.css" type="text/css" />
	<title>Manicure for you</title>
</head>
<body>
	<header class="head_main">
		<div class="text_head">
			<p><a href="../main_page.php">MANICURE FOR YOU</a></p>
		</div>
	</header>

	<main>
		<div class="reqKlientMain">
			<div class="reqKlientContainer">
				<p class="reqKlientText">ЗАПИСЬ ОНЛАЙН</p>
				<input type="hidden" name="id"/>
				<div class="reqDataCont">
					<label class="reqKlientText2" for="master">Выберите мастера:</label>
        			<select class="inputReqKlient2" id="master">

        			</select>
					<label class="reqKlientText2" for="date">Выберите дату:</label>
        			<input class="inputReqKlient" type="date" id="date" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+1 month')); ?>">
        			<label class="reqKlientText2" for="time">Выберите время:</label>
        			<select class="inputReqKlient2" id="time" >
			            <option value="12:00">12:00</option>
			            <option value="14:00">14:00</option>
			            <option value="16:00">16:00</option>
			            <option value="18:00">18:00</option>
			            <option value="20:00">20:00</option>
       				</select>
       				<button id="record-button">Записаться</button>
				</div>
				<script src="script.js"></script>
			</div>
		</div>
	</main>
</body>
</html>