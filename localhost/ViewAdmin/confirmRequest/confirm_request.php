<?php
// Подключение к базе данных
include_once '../../config.php';

// Получение ID клиента и ID заявки
$clientId = $_GET['clientId'];
$requestId = $_GET['requestId'];
$date = $_GET['date'];
$time = $_GET['time'];
$klient = $_GET['klient'];
$master = $_GET['master'];

// Обновление статуса заявки
$sql = "UPDATE KlientRequest SET Confimed = 1 WHERE IdRequest = $requestId";
if ($conn->query($sql) === TRUE) {
    // Запись уведомления
    $notificationText = "Уважаемая " .$klient. ", Ваша запись подтверждена! Ждем вас " .$date. " в " .$time. ". Мастер - " .$master. ". ";
    $sql1 = "INSERT INTO Notification (IdKlient, NotifText, IdRequest) VALUES ($clientId, '$notificationText', $requestId)";
    if ($conn->query($sql1) === TRUE) {
        echo "Запись подтверждена и уведомление отправлено";
    } else {
        echo "Ошибка записи уведомления";
    }
} else {
    echo "Ошибка подтверждения записи";
}

// Закрытие соединения с базой данных
$conn->close();
?>