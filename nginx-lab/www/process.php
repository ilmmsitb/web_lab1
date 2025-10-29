<?php
session_start();
require_once 'db.php';
require_once 'Excursion.php';

$excursion = new Excursion($pdo);

// Получаем данные формы
$name = htmlspecialchars($_POST['name']);
$excursion_date = $_POST['excursion_date'];
$route = $_POST['route'];
$audio_guide = isset($_POST['audio_guide']) ? 'Да' : 'Нет';
$language = $_POST['language'];
$email = $_POST['email'];

// Сохраняем в сессию
$_SESSION['name'] = $name;
$_SESSION['excursion_date'] = $excursion_date;
$_SESSION['route'] = $route;
$_SESSION['audio_guide'] = $audio_guide;
$_SESSION['language'] = $language;
$_SESSION['email'] = $email;

// Сохраняем в MySQL
$excursion->add($name, $excursion_date, $route, $audio_guide, $language, $email);

// Также сохраняем в файл для обратной совместимости
$line = $name . ";" . $excursion_date . ";" . $route . ";" . $audio_guide . ";" . $language . ";" . $email . "\n";
file_put_contents("data.txt", $line, FILE_APPEND);

// Устанавливаем куки
setcookie("last_submission", date('Y-m-d H:i:s'), time() + 3600, "/");

header("Location: index.php");
exit();
?>