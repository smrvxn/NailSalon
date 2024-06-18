<?php
    session_start();
    if(empty($_SESSION['IdAdmin']))
    {
        header('Location: ../loginAdmin.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../styleAdmin.css" type="text/css" />
	<title>Manicure for you</title>
</head>
<body>
	<header class="head_main">
        <div class="text_head">
            <p>MANICURE FOR YOU</p>
        </div>
    </header>

    <main>
    	<div class="addPhotoMain">
    		<div class="addPhotoCont">
    			<form method="post" enctype="multipart/form-data" action="addPhScript.php" class="formColumn">
    				<p class="textAddPhoto">Добавить работу</p>
    				<input type="file" class="inputnewPhoto" name="NewPhoto"/>
    				<button class="buttonAddNewPh">Добавить</button>
    			</form>
    		</div>
    	</div>
    </main>
</body>
</html>