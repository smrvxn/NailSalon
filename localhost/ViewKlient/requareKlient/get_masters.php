

 <?php

include_once '../../config.php';

// Запрос к базе данных для получения списка мастеров
$sql = "SELECT IdMaster, FIO FROM Master";
$result = $conn->query($sql);

// Формирование массива с данными
$masters = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $masters[] = array(
            'id' => $row['IdMaster'],
            'name' => $row['FIO']
        );
    }
}

// Преобразование массива в JSON и отправка ответа
header('Content-Type: application/json');
echo json_encode($masters);

// Закрытие соединения с базой данных
$conn->close();
?>