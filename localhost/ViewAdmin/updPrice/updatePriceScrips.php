<?php

	include_once '../../config.php';

	$id = $_POST['IdServices'];
	$name = $_POST['Name'];
	$price = $_POST['Price'];

	mysqli_query($conn, "UPDATE Services SET Name = '$name', Price = '$price' WHERE IdServices = '$id'");
	header('Location: updatePrice.php');
?>