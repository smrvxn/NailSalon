<?php
session_start();

// Удалим сессию
session_destroy();
// После выхода из системы перейдем на главную страницу
header('Location: loginManager.php');
exit;
?>