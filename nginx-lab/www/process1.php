<?php
session_start();

// Получаем данные формы
$name = htmlspecialchars($_POST['name']);
$excursion_date = htmlspecialchars($_POST['excursion_date']);
$route = htmlspecialchars($_POST['route']);
$audio_guide = isset($_POST['audio_guide']) ? 'Да' : 'Нет';
$language = htmlspecialchars($_POST['language']);
$email = htmlspecialchars($_POST['email']);

// Сохраняем данные в сессию
$_SESSION['name'] = $name;
$_SESSION['excursion_date'] = $excursion_date;
$_SESSION['route'] = $route;
$_SESSION['audio_guide'] = $audio_guide;
$_SESSION['language'] = $language;
$_SESSION['email'] = $email;

// Формируем строку для сохранения
$line = $name . ";" . $excursion_date . ";" . $route . ";" . $audio_guide . ";" . $language . ";" . $email . ";" . date('Y-m-d H:i:s') . "\n";

// Сохраняем в файл (файл создастся автоматически)
$result = file_put_contents('data.txt', $line, FILE_APPEND);

// Если не получилось, пробуем с полным путем
if ($result === false) {
    $result = file_put_contents(__DIR__ . '/data.txt', $line, FILE_APPEND);
}

// Перенаправляем обратно
header("Location: index.php");
exit();
?>