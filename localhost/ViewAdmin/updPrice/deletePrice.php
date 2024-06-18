<?php

	include_once '../../config.php';

	$id = $_POST['IdServices'];


	mysqli_query($conn, "DELETE FROM Services WHERE IdServices = '$id'");
		header('Location: updatePrice.php');


?>