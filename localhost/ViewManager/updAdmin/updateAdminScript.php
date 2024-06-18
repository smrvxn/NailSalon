<?php 
		
	include_once '../../config.php';

	$id = $_POST['id'];
	$fio = $_POST['FIO'];
	$phone = $_POST['Phone'];
	$login = $_POST['Login'];
	$password = $_POST['Password'];

	mysqli_query($conn, "UPDATE Admin SET FIO = '$fio', Phone = '$phone', Login = '$login', Password = '$password' WHERE IdAdmin = '$id'");
	header('Location: ../mainManager.php');
?>