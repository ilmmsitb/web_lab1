<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<!DOCTYPE html>
    <html lang='ru'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Результат записи</title>
        <style>
            body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; }
            .result { background: #f8f9fa; padding: 30px; border-radius: 10px; border-left: 5px solid #3498db; }
            h1 { color: #2c3e50; }
            .field { margin: 10px 0; padding: 10px; background: white; border-radius: 5px; }
            .back-btn { background: #3498db; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin-top: 20px; }
        </style>
    </head>
    <body>
        <div class='result'>
            <h1>✅ Запись принята!</h1>
            <p>Спасибо за вашу заявку. Вот данные вашей записи:</p>";
    
    $name = htmlspecialchars($_POST['name']);
    $date = htmlspecialchars($_POST['excursion_date']);
    $route = htmlspecialchars($_POST['route']);
    $audio_guide = isset($_POST['audio_guide']) ? 'Да' : 'Нет';
    $language = htmlspecialchars($_POST['language']);
    $email = htmlspecialchars($_POST['email']);
    
    echo "<div class='field'><strong>Имя:</strong> $name</div>";
    echo "<div class='field'><strong>Дата экскурсии:</strong> $date</div>";
    echo "<div class='field'><strong>Маршрут:</strong> $route</div>";
    echo "<div class='field'><strong>Аудиогид:</strong> $audio_guide</div>";
    echo "<div class='field'><strong>Язык экскурсии:</strong> $language</div>";
    echo "<div class='field'><strong>Email:</strong> $email</div>";
    
    echo "<br><p>Мы отправили подтверждение на ваш email.</p>";
    echo "<a href='/form.html' class='back-btn'>← Вернуться к форме</a>";
    echo "</div></body></html>";
} else {
    header("Location: /form.html");
    exit();
}
?>