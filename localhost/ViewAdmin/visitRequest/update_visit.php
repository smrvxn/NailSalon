<?php
// Подключение к базе данных
include_once('../../config.php');

// Получение ID клиента, ID заявки и статуса посещения
$clientId = $_GET['clientId'];
$requestId = $_GET['requestId'];
$visitStatus = $_GET['visitStatus'];

  echo($clientId);
  echo($requestId);
  echo($visitStatus);

//Обновление статуса посещения
$sql = "UPDATE KlientRequest SET Visit = $visitStatus WHERE IdRequest = $requestId";
if ($conn->query($sql) === TRUE) {
    // Запись уведомления (если посещение состоялось)
    if ($visitStatus == 1) {
        $notificationText = "Пожалуйста, оцените качество полученной услуги.";
        $url = "feedback.php?requestId=$requestId";
        $stmt = $conn->prepare("INSERT INTO Notification (IdKlient, NotifText, IdRequest, UrlForKlient) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isis", $clientId, $notificationText, $requestId, $url);


        if ($stmt->execute() === TRUE) {
            echo "Статус посещения обновлен, уведомление отправлено";
        } else {
            echo "Ошибка записи уведомления";
        }
    } else {
        echo "Статус посещения обновлен";
    }
} else {
    echo "Ошибка обновления статуса посещения";
}

// Закрытие соединения с базой данных
$conn->close();
?>