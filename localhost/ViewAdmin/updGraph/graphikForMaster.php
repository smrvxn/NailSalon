<?php
	session_start();
    if(empty($_SESSION['IdAdmin']))
    {
        header('Location: ../loginAdmin.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../styleAdmin.css" type="text/css" />
	<title>Manicure for you</title>
</head>
<body>
	<header class="head_main">
		<div class="text_head">
			<p>MANICURE FOR YOU</p>
		</div>
	</header>

	<main>
		<div class="graphMasterMain">
			<div class="graphMasterCont">
				<p class="textGraphMaster">График работы</p>
				<div id="master-selection">
			      <label class="text" for="master-select">Выберите мастера</label>
			      <select class="text2" id="master-select"></select>
			      <label class="text" for="month-select">Выберите месяц</label>
			      <select class="text2" id="month-select">
			        <option value="1">Январь</option>
			        <option value="2">Февраль</option>
			        <option value="3">Март</option>
			        <option value="4">Апрель</option>
			        <option value="5">Май</option>
			        <option value="6">Июнь</option>
			        <option value="7">Июль</option>
			        <option value="8">Август</option>
			        <option value="9">Сентябрь</option>
			        <option value="10">Октябрь</option>
			        <option value="11">Ноябрь</option>
			        <option value="12">Декабрь</option>
			      </select>
			    </div>
			    <div class="buttonDiv">
			    	<button id="next-btn">Далее</button>

			    </div>
			    <div id="calendar-container" class="hidden">
			      <div id="calendar"></div>

			    </div>
				<button id="save-btn">Сохранить</button>

			</div>
			<script src="script.js"></script>
		</div>
	</main>
</body>
</html>