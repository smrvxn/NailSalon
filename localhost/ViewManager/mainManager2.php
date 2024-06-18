<?php
session_start();
if(empty($_SESSION['IdManager']))
{
    header('Location: loginManager.php');
    exit;
}
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
			<button class="button12_head"><a href="mainManager.php">Добавить администратора</a></button>
			<button class="button12_head"><a href="">Просмотр посещаемости</a></button>
			<button class="button1_head"><a href="logoutManager.php">Выйти</a></button>
		</div>
	</header>

	<main>
		<div class="manager_main">
			<div class="manager_main_container">
				<p class="posText">Посещаемость</p>
				<div class="contSettings">

					<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="formRow">
						<div class="formRow1">
							<p class="posText2">Мастер </p>
						    <select class="posSelect" name="master" id="master">
						        <option value="">Все мастера</option>
						        <?php
						        include_once '../config.php';

						        // Получение списка мастеров из базы данных
						        $sql = "SELECT IdMaster, FIO FROM Master";
						        $result = $conn->query($sql);

						        // Вывод списка мастеров в select
						        while ($row = $result->fetch_assoc()) {
						            echo "<option class='posOption' value='" . $row['IdMaster'] . "'>" . $row['FIO'] . "</option>";
						        }
						        ?>
						    </select>
						</div>
						<div class="formRow1">
							<p class="posText2" >Период </p>
						    <select class="posSelect" name="period" id="period">
						        <option class="posOption" value="6 месяцев">6 месяцев</option>
						        <option class="posOption" value="3 месяца">3 месяца</option>
						        <option class="posOption" value="месяц">Месяц</option>
						        <option class="posOption" value="неделя">Неделя</option>
						    </select>
						</div>
						<input type="submit" value="Показать записи" class="posPutton">
					</form>
				</div>
				<div class="posTable">
					<?php
					// Обработка формы
					if ($_SERVER['REQUEST_METHOD'] === 'POST') {
					    $masterId = isset($_POST['master']) ? $_POST['master'] : '';
					    $period = isset($_POST['period']) ? $_POST['period'] : '';

					    // Подключение к базе данных
					    include_once '../config.php';

					    // Создание запроса в зависимости от выбранных параметров
					    $sql = "SELECT
					                KlientRequest.IdRequest,
					                Master.FIO,
					                Klient.KlientName,
					                KlientRequest.Date,
					                KlientRequest.Time,
					                KlientRequest.Confimed,
					                KlientRequest.Visit
					            FROM
					                KlientRequest
					            JOIN
					                Master ON KlientRequest.IdMaster = Master.IdMaster
					            JOIN
					                Klient ON KlientRequest.IdKlient = Klient.IdKlient";

					    // Фильтрация по мастеру
					    if ($masterId) {
					        $sql .= " WHERE KlientRequest.IdMaster = '$masterId'";
					    }

					    // Фильтрация по периоду
					    if ($period) {
					        if (!empty($masterId)) {
					            $sql .= " AND ";
					        } else {
					            $sql .= " WHERE ";
					        }

					        switch ($period) {
					            case '6 месяцев':
					                $sql .= "KlientRequest.Date >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)";
					                break;
					            case '3 месяца':
					                $sql .= "KlientRequest.Date >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)";
					                break;
					            case 'месяц':
					                $sql .= "KlientRequest.Date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
					                break;
					            case 'неделя':
					                $sql .= "KlientRequest.Date >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)";
					                break;
					        }
					    }

					    // Выполнение запроса
					    $result = $conn->query($sql);
					    $rows = $result->num_rows;

					    // Вывод результатов
					    if ($result->num_rows > 0) {
					        echo "<p class='posText'>Количество записей: ". $rows ."</p>"; ?>

					        <div class="posHeadTable">
					        	<p class="posHeadTableText">Мастер</p>
					        	<p class="posHeadTableText">Клиент</p>
					        	<p class="posHeadTableText">Дата</p>
					        	<p class="posHeadTableText">Время</p>
					        	<p class="posHeadTableText">Посещение</p>
					        </div>
							<div class="posDivTable">
					         <?php
						        while ($row = $result->fetch_assoc()) { ?>
									<div class="posHeadTable">
							            <p class="postTextTable"><?= $row['FIO'] ?></p>
							            <p class="postTextTable"><?= $row['KlientName'] ?></p>
							            <p class="postTextTable"><?= $row['Date'] ?></p>
							            <p class="postTextTable"><?= $row['Time'] ?></p>
							            <p class="postTextTable"><?= ($row['Visit'] == 1 ? 'Да' : 'Нет') ?></p>
						            </div>
						        <?php } ?>
					    	</div>
					    <?php
					    } else {
					        echo "<p class='posText'>Записи не найдены</p>";
					    }

					    // Закрытие соединения
					    $conn->close();
					}

				?>
				</div>
			</div>
		</div>
	</main>
</body>
</html>