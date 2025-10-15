<?php
session_start();

// Получаем данные формы через $_POST
$name = htmlspecialchars($_POST['name']);
$excursion_date = htmlspecialchars($_POST['excursion_date'] ?? '');
$route = htmlspecialchars($_POST['route'] ?? '');
$audio_guide = isset($_POST['audio_guide']) ? 'Да' : 'Нет';
$language = htmlspecialchars($_POST['language'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');

// Сохраняем все данные в сессию
$_SESSION['name'] = $name;
$_SESSION['excursion_date'] = $excursion_date;
$_SESSION['route'] = $route;
$_SESSION['audio_guide'] = $audio_guide;
$_SESSION['language'] = $language;
$_SESSION['email'] = $email;

// После сохранения в сессию перенаправляем обратно на главную страницу
header("Location: index.php");
exit();
?>