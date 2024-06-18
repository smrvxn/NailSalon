<?php $data = json_decode(file_get_contents('php://input'), true);
$masterId = $data['masterId'];
$month = $data['month'];
$workingDays = $data['workingDays'];

$conn = new mysqli('localhost', 'root', '', 'NailSalonDB');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$sql = "DELETE FROM WorkScedule WHERE IdMaster = ? AND Month = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $masterId, $month);
$stmt->execute();
$stmt->close();

$sql = "INSERT INTO WorkScedule (IdMaster, Month, Days) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
foreach ($workingDays as $day) {
    $stmt->bind_param("iii", $masterId, $month, $day);
    $stmt->execute();
}
$stmt->close();

$conn->close();

echo json_encode(['status' => 'success']);
?>