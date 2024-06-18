<?php

$upload_dir = '../../worksImages/';

// Проверка на отправку формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$file = $_FILES['NewPhoto'];

    // Проверка на отсутствие ошибок
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Получение имени файла
        $filename = $file['name'];

        // Путь для загрузки файла
        $upload_file = $upload_dir . basename($filename);

        // Загрузка файла
        if (move_uploaded_file($file['tmp_name'], $upload_file)) {

            header ("Location: addPhoto.php");

        } else {
            echo "Ошибка при загрузке файла.";
        }
    } else {
        echo "Ошибка при выборе файла.";
    }
}
?>