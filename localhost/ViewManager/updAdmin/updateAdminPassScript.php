<?php

	include_once '../../config.php';

	$id = $_POST['id'];
	$fio = $_POST['FIO'];
	$phone = $_POST['Phone'];
	$login = $_POST['Login'];
	$password = $_POST['Password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


	mysqli_query($conn, "UPDATE Admin SET FIO = '$fio', Phone = '$phone', Login = '$login', Password = '$hashed_password' WHERE IdAdmin = '$id'");
	header('Location: ../mainManager.php');
?>