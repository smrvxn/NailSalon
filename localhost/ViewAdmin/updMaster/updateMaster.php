<?php

session_start();
    if(empty($_SESSION['IdAdmin']))
    {
        header('Location: ../loginAdmin.php');
    }

include_once '../../config.php';

$masters = mysqli_query($conn, "SELECT * FROM Master");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../styleAdmin.css" type="text/css" />
	<title>Manicure For You</title>
</head>
<body>
	<header class="head_main">
        <div class="text_head">
            <p>MANICURE FOR YOU</p>
        </div>
    </header>

    <main>
    	<div class="updateMasterMain">
	    	<?php while($master = mysqli_fetch_assoc($masters)) { ?>
	    		<div class="rowFormMaster">
		    		<form method="post" action="updateMasterScript.php" class="formUpdateMaster">

		   				<input type="hidden" name="IdMaster" value="<?= $master['IdMaster']?>" />
		   				<input class="updMasterInp1" name="FIO" type="text" class="mastersInput" value="<?= $master['FIO']?>"/>
		   				<input class="updMasterInp1" name="Qualification" type="text" class="mastersInput" value="<?= $master['Qualification']?>" />
		    			<input class="updMasterInp2" name="WorkExperience" type="text" class="mastersInput" value="<?= $master['WorkExperience']?>" />
		   				<textarea class="updMasterInp3" name="Information" class="mastersInput" ><?= $master['Information']?></textarea>
	   					<input type="hidden" name="Image" value="<?= $master['Image']?>" />
						<button class="updateSaveMaster">Сохранить</button>
		   			</form>
		    		<form  method="post" action="deleteMaster.php">
		   				<input type="hidden" name="IdMaster" value="<?= $master['IdMaster']?>"/>
    					<button class="deleteMasterButt">Удалить</button>
	    			</form>
	    		</div>
	    	<?php }  	?>
	    	<a class="addButtonMaster" href="addMaster.php">Добавить мастера</a>
    	</div>
    </main>
</body>
</html>