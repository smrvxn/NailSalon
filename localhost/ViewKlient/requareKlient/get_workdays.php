<?php
// Подключение к базе данных
include_once '../../config.php';

// Получение id мастера из запроса
$masterId = $_GET['masterId'];

// Запрос для получения рабочих дней мастера
$sql = "SELECT * FROM WorkScedule WHERE IdMaster = '$masterId'";
$result = $conn->query($sql);

// Формирование массива с рабочими днями
$workdays = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $workdays[] = array(
            'year' => date('Y'), // Добавлен год
            'month' => $row['month'],
            'day' => $row['day']
        );
    }
}

// Отправка ответа в формате JSON
header('Content-Type: application/json');
echo json_encode($workdays);

// Закрытие соединения с базой данных
$conn->close();