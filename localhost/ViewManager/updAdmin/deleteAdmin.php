<?php

	include_once '../../config.php';

	$id = $_GET['id'];


	mysqli_query($conn, "DELETE FROM Admin WHERE IdAdmin = '$id'");
		header('Location: ../mainManager.php');


?>