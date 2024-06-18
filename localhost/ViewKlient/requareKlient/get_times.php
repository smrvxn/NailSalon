<?php

include_once '../../config.php';

// Получение даты и мастера из запроса
$date = $_GET['date'];
$masterId = $_GET['masterId']; // Добавляем получение masterId

// Запрос для получения доступных времен для выбранной даты и мастера
$sql = "SELECT * FROM WorkScedule WHERE IdMaster = '$masterId' AND Month = MONTH('$date') AND Days = DAY('$date')";
$result = $conn->query($sql);

// Формирование массива с доступными временами
$times = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Проверка, занято ли время
        $isTimeBooked = false;
        $sql = "SELECT * FROM KlientRequest WHERE IdMaster = '$masterId' AND Date(date) = '$date' AND Time = '12:00'";
        $checkResult = $conn->query($sql);
        if ($checkResult->num_rows > 0) {
            $isTimeBooked = true;
        }

        if (!$isTimeBooked) {
            $times[] = '12:00';
        }

        // Проверка остальных времен (14:00, 16:00, 18:00, 20:00) аналогично

        $isTimeBooked = false;
        $sql = "SELECT * FROM KlientRequest WHERE IdMaster = '$masterId' AND Date(date) = '$date' AND Time = '14:00'";
        $checkResult = $conn->query($sql);
        if ($checkResult->num_rows > 0) {
            $isTimeBooked = true;
        }

        if (!$isTimeBooked) {
            $times[] = '14:00';
        }

        $isTimeBooked = false;
        $sql = "SELECT * FROM KlientRequest WHERE IdMaster = '$masterId' AND Date(date) = '$date' AND Time = '16:00'";
        $checkResult = $conn->query($sql);
        if ($checkResult->num_rows > 0) {
            $isTimeBooked = true;
        }

        if (!$isTimeBooked) {
            $times[] = '16:00';
        }

        $isTimeBooked = false;
        $sql = "SELECT * FROM KlientRequest WHERE IdMaster = '$masterId' AND Date(date) = '$date' AND Time = '18:00'";
        $checkResult = $conn->query($sql);
        if ($checkResult->num_rows > 0) {
            $isTimeBooked = true;
        }

        if (!$isTimeBooked) {
            $times[] = '18:00';
        }

        $isTimeBooked = false;
        $sql = "SELECT * FROM KlientRequest WHERE IdMaster = '$masterId' AND Date(date) = '$date' AND Time = '20:00'";
        $checkResult = $conn->query($sql);
        if ($checkResult->num_rows > 0) {
            $isTimeBooked = true;
        }

        if (!$isTimeBooked) {
            $times[] = '20:00';
        }
    }
}

// Отправка ответа в формате JSON

header('Content-Type: application/json');
echo json_encode($times);

// Закрытие соединения с базой данных
$conn->close();
?>