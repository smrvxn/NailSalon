<?php
// Подключение к базе данных
include_once('../../config.php');

// Получение сегодняшней даты
$today = date('Y-m-d');

// Запрос к базе данных для получения списка посещений
$sql = "SELECT kr.IdRequest, kr.IdKlient, kr.IdMaster, kr.Date, kr.Time, kr.Visit, k.KlientName, m.FIO
        FROM KlientRequest kr
        JOIN Klient k ON kr.IdKlient = k.IdKlient
        JOIN Master m ON kr.IdMaster = m.IdMaster
        WHERE kr.Visit = 0 AND kr.Confimed = 1 AND kr.Date = '$today'";
$result = $conn->query($sql);

// Формирование массива с данными
$visits = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $visits[] = array(
            'IdKlient' => $row['IdKlient'],
            'IdRequest' => $row['IdRequest'],
            'KlientName' => $row['KlientName'],
            'FIO' => $row['FIO'],
            'Date' => $row['Date'],
            'Time' => $row['Time'],
            'Visit' => $row['Visit']
        );
    }
}

// Преобразование массива в JSON и отправка ответа
header('Content-Type: application/json');
echo json_encode($visits);

// Закрытие соединения с базой данных
$conn->close();
?>