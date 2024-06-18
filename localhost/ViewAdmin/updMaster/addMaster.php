<?php

    session_start();
    if(empty($_SESSION['IdAdmin']))
    {
        header('Location: ../loginAdmin.php');
        exit;
    }

include_once '../../config.php';
// Папка для загрузки файлов
$upload_dir = '../../images/people/';

// Проверка на отправку формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение файла из формы
    $file = $_FILES['photo'];
    $fio = $_POST['FIO'];
    $qual = $_POST['Qualification'];
    $work = $_POST['WorkExperience'];
    $info = $_POST['Information'];

    // Проверка на отсутствие ошибок
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Получение имени файла
        $filename = $file['name'];

        // Путь для загрузки файла
        $upload_file = $upload_dir . basename($filename);

        // Загрузка файла
        if (move_uploaded_file($file['tmp_name'], $upload_file)) {

            mysqli_query($conn, "INSERT INTO Master (FIO, Qualification, WorkExperience, Information, Image) VALUES ('$fio', '$qual', '$work', '$info', '$filename')");
            header ('Location: updateMaster.php');

        } else {
            echo "Ошибка при загрузке файла.";
        }
    } else {
        echo "Ошибка при выборе файла.";
    }
}
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
            <p><a href="main_page.php">MANICURE FOR YOU</a></p>
        </div>
    </header>

    <main>
        <div class="mainAddMaster">
            <form method="post" enctype="multipart/form-data">
                <div class="addMasterContainer">
                    <p class="textAddMaster">Добавить мастера</p>
                    <input type="file" class="inputPhoto" name="photo"/>
                    <input type="text" name="FIO" class="inputTextMaster" placeholder="Имя"/>
                    <input type="text" name="Qualification" class="inputTextMaster" placeholder="Квалификация"/>
                    <input type="text" name="WorkExperience" class="inputTextMaster" placeholder="Стаж работы"/>
                    <textarea name="Information" class="inputDeckMaster" placeholder="Дополнительная информация"></textarea>
                    <button type="submit" class="buttonAddMaster">Загрузить</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>

