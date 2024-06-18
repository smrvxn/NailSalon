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
				<table id="requestsTable">
					<thead>
					  <tr class="headerTableConf">
					    <th>Имя Мастера</th>
					    <th>Имя Клиента</th>
					    <th>Дата</th>
					    <th>Время</th>
					    <th>Действие</th>
					  </tr>
				  <thead>
				  	<tbody class="rowTableConf">
        		</tbody>
				</table>
			</div>
		</div>
	</main>

<script>
        // Функция для заполнения таблицы
        function populateRequestsTable() {
            fetch('get_requests.php')
                .then(response => response.json())
                .then(requests => {
                    const tableBody = document.getElementById('requestsTable').getElementsByTagName('tbody')[0];
                    tableBody.innerHTML = '';
                    requests.forEach(request => {
                        const row = tableBody.insertRow();
                        const clientCell = row.insertCell();
                        const masterCell = row.insertCell();
                        const dateCell = row.insertCell();
                        const timeCell = row.insertCell();
                        const confirmButtonCell = row.insertCell();

                        clientCell.innerHTML = request.KlientName; // Вывод имени клиента
                        masterCell.innerHTML = request.FIO; // Вывод имени мастера
                        dateCell.innerHTML = request.Date;
                        timeCell.innerHTML = request.Time;

                        const confirmButton = document.createElement('button');
                        confirmButton.className = "confButton";
                        confirmButton.textContent = 'Подтвердить';
                        confirmButton.addEventListener('click', () => {
                            confirmRequest(request.IdKlient, request.IdRequest, request.Date, request.Time, request.KlientName, request.FIO);
                        });
                        confirmButtonCell.appendChild(confirmButton);
                    });
                });
        }

        // Функция для подтверждения заявки
        function confirmRequest(clientId, requestId, date, time, klient, master) {
            fetch('confirm_request.php?clientId=' + clientId + '&requestId=' + requestId + '&date=' + date + '&time=' + time + '&klient=' + klient + '&master=' + master)
                .then(response => {
                    populateRequestsTable();
                });
        }

        // Вызов функции при загрузке страницы
        window.onload = populateRequestsTable;
    </script>
</body>
</html>