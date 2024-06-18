<?php

	include_once '../../config.php';

	$id = $_POST['IdMaster'];
	$fio = $_POST['FIO'];
	$qual = $_POST['Qualification'];
	$work = $_POST['WorkExperience'];
	$info = $_POST['Information'];
	$img = $_POST['Image'];

	mysqli_query($conn, "UPDATE Master SET FIO = '$fio', Qualification = '$qual', WorkExperience = '$work', Information = '$info', Image = '$img' WHERE IdMaster = '$id'");
	header ('Location: updateMaster.php');

?>