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
		<div class="mainConfimedReq">
			<div class="containerConfimedReq">
				 <table id="visitsTable" class="headerTableConf">
			        <thead>
			            <tr>
			                <th>Клиент</th>
			                <th>Мастер</th>
			                <th>Дата</th>
			                <th>Время</th>
			                <th>Статус</th>
			                <th>Действия</th>
			            </tr>
			        </thead>
			        <tbody >
			        </tbody>
			    </table>
			</div>
    </div>
    <script>
        // Функция для заполнения таблицы
        function populateVisitsTable() {
            fetch('functions.php')
                .then(response => response.json())
                .then(visits => {
                    const tableBody = document.getElementById('visitsTable').getElementsByTagName('tbody')[0];
                    tableBody.innerHTML = ''; // Очищаем таблицу перед добавлением новых записей
                    visits.forEach(visit => {
                        const row = tableBody.insertRow();
                        row.className = 'rowTableConf';
                        const clientCell = row.insertCell();
                        const masterCell = row.insertCell();
                        const dateCell = row.insertCell();
                        const timeCell = row.insertCell();
                        const statusCell = row.insertCell();
                        const actionsCell = row.insertCell();

                        clientCell.innerHTML = visit.KlientName;
                        masterCell.innerHTML = visit.FIO;
                        dateCell.innerHTML = visit.Date;
                        timeCell.innerHTML = visit.Time;
                        statusCell.innerHTML = visit.Visit === 1 ? 'Посетил' : (visit.Visit === 2 ? 'Не посетил' : 'Ожидает');

                        const visitedButton = document.createElement('button');
                        visitedButton.className = 'visitButton';
                        visitedButton.textContent = 'Посетил';
                        visitedButton.addEventListener('click', () => {
                            markVisit(visit.IdKlient, visit.IdRequest, 1);
                        });

                        const notVisitedButton = document.createElement('button');
                        notVisitedButton.className = 'visitButton';
                        notVisitedButton.textContent = 'Не посетил';
                        notVisitedButton.addEventListener('click', () => {
                            markVisit(visit.IdKlient, visit.IdRequest, 2);
                        });

                        actionsCell.appendChild(visitedButton);
                        actionsCell.appendChild(notVisitedButton);
                    });
                });
        }

        // Функция для обновления статуса посещения
        function markVisit(clientId, requestId, visitStatus) {
            fetch('update_visit.php?clientId=' + clientId + '&requestId=' + requestId + '&visitStatus=' + visitStatus)
                .then(response => {
                    populateVisitsTable();
                });
        }

        // Вызов функции при загрузке страницы
        window.onload = populateVisitsTable;
    </script>

</main>
</body>
</html>