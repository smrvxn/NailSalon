<?php

	include_once '../../config.php';

	$name = $_POST['Name'];
	$price = $_POST['Price'];

	mysqli_query($conn, "INSERT INTO Services (Name, Price) VALUES ('$name', '$price')");
	header ('Location: updatePrice.php');

?>