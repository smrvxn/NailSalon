<?php $conn = new mysqli('localhost', 'root', '', 'NailSalonDB');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$sql = "SELECT IdMaster, FIO FROM Master";
$result = $conn->query($sql);

$masters = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $masters[] = ['id' => $row['IdMaster'], 'name' => $row['FIO']];
    }
}

echo json_encode($masters);
$conn->close();
?>