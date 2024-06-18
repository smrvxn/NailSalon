<?php

include_once '../../config.php';

$id = $_POST['id'];
$name = $_POST['name'];
$birth = $_POST['birth'];
$phone = $_POST['phone'];
$email = $_POST['email'];

mysqli_query($conn, "UPDATE Klient SET KlientName = '$name', Birthday = '$birth', Phone = '$phone', Email = '$email' WHERE IdKlient = '$id'");

header ('Location: accountMain.php');

?>