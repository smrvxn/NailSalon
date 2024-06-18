<?php
$masterId = $_GET['masterId'];
$month = $_GET['month'];

$conn = new mysqli('localhost', 'root', '', 'NailSalonDB');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$sql = "SELECT Days FROM WorkScedule WHERE IdMaster = ? AND Month = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $masterId, $month);
$stmt->execute();
$result = $stmt->get_result();

$workingDays = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $workingDays[] = $row['Days'];
    }
}

echo json_encode($workingDays);
$stmt->close();
$conn->close();
?>