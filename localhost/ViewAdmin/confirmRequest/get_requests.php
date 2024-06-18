<?php
// Подключение к базе данных
include_once '../../config.php';

// Запрос к базе данных для получения списка заявок
$sql = "SELECT KlientRequest.IdRequest, KlientRequest.IdKlient, KlientRequest.IdMaster, KlientRequest.Date, KlientRequest.Time, KlientRequest.Confimed, Klient.KlientName, Master.FIO
        FROM KlientRequest
        JOIN Klient ON KlientRequest.IdKlient = Klient.IdKlient
        JOIN Master ON KlientRequest.IdMaster = Master.IdMaster
        WHERE KlientRequest.Confimed = 0";
$result = $conn->query($sql);

// Формирование массива с данными
$requests = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $requests[] = array(
            'IdKlient' => $row['IdKlient'], // Сохраняем ID для подтверждения
            'IdRequest' => $row['IdRequest'], // Сохраняем ID для подтверждения
            'KlientName' => $row['KlientName'],
            'FIO' => $row['FIO'],
            'Date' => $row['Date'],
            'Time' => $row['Time'],
            'Confimed' => $row['Confimed']
        );
    }
}

// Преобразование массива в JSON и отправка ответа
header('Content-Type: application/json');
echo json_encode($requests);

// Закрытие соединения с базой данных
$conn->close();
?>