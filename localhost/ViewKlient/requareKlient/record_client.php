<?php
include_once '../../config.php';

session_start();

$id = $_SESSION['IdKlient'];

$masterId = $_GET['masterId'];
$date = $_GET['date'];
$time = $_GET['time'];

$sql = "SELECT * FROM KlientRequest WHERE IdMaster = '$masterId' AND Date(date) = '$date' AND Time = '$time'";
$checkResult = $conn->query($sql);
if ($checkResult->num_rows > 0) {
    $response = array(
        'success' => false,
        'error' => 'Время занято!'
    );
    echo json_encode($response);
        exit();
} else {
    $sql = "INSERT INTO KlientRequest (IdKlient, IdMaster, Date, Time, Confimed, Visit) VALUES ('$id', '$masterId', '$date', '$time', 0, 0)";

    if ($conn->query($sql) === TRUE) {

        $response = array(
            'success' => true,
            'error' => ''
        );
        echo json_encode($response);
        exit();



    } else {
        $response = array(
            'success' => false,
            'error' => 'Ошибка при записи в базу данных: ' . $conn->error
        );
        echo json_encode($response);
        exit();
    }
}

header('Content-Type: application/json');


$conn->close();
?>