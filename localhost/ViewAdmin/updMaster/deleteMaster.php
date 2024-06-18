<?php

	include_once '../../config.php';

	$id = $_POST['IdMaster'];

	mysqli_query($conn, "DELETE FROM Master WHERE IdMaster = '$id'");
	header ('Location: updateMaster.php');

?>
