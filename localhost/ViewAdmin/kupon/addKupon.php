<?php

// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "NailSalonDB";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение клиентов с сегодняшним днем рождения
$todayMonth = date('m');
$todayDay = date('d');

// SQL-запрос для проверки месяца и дня без учета года
$sql = "SELECT IdKlient FROM Klient WHERE MONTH(Birthday) = '$todayMonth' AND DAY(Birthday) = '$todayDay'";
$result = $conn->query($sql);
// Обработка именинников
if ($result->num_rows > 0) {
    // Если есть именинники, отправляем купоны
    $num_birthday_clients = $result->num_rows;
    echo "Купоны отправлены для $num_birthday_clients человек";

    while ($row = $result->fetch_assoc()) {
        $client_id = $row['IdKlient'];
        $notif_text = "С Днем Рождения!";
        $url = "birthdayCupon.php?IdKlient=$client_id";

        // Вставка уведомления
        mysqli_query($conn, "INSERT INTO Notification (IdKlient, NotifText, UrlForKlient) VALUES ('$client_id', '$notif_text', '$url')");
    }
} else {
    echo "Сегодня именинников нет";
}

$conn->close();

?>