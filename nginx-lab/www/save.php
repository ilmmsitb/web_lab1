<?php
session_start();

// Очистка предыдущих ошибок
$_SESSION['errors'] = [];

// Валидация данных
if (empty($_POST['name'])) {
    $_SESSION['errors'][] = "Имя обязательно для заполнения";
}

if (empty($_POST['excursion_date'])) {
    $_SESSION['errors'][] = "Дата экскурсии обязательна для заполнения";
}

if (empty($_POST['route'])) {
    $_SESSION['errors'][] = "Выберите маршрут";
}

if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $_SESSION['errors'][] = "Введите корректный email";
}

// Если есть ошибки, возвращаем на форму
if (!empty($_SESSION['errors'])) {
    header('Location: form.html');
    exit();
}

// Сохранение данных в сессию
$_SESSION['name'] = $_POST['name'];
$_SESSION['excursion_date'] = $_POST['excursion_date'];
$_SESSION['route'] = $_POST['route'];
$_SESSION['audio_guide'] = isset($_POST['audio_guide']) ? 'Да' : 'Нет';
$_SESSION['language'] = $_POST['language'] ?? 'Русский';
$_SESSION['email'] = $_POST['email'];

// Установка куки
setcookie("last_submission", date('Y-m-d H:i:s'), time() + 3600, "/");

// Перенаправление на главную страницу
header('Location: index.php');
exit();