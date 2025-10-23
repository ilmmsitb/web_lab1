<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            max-width: 800px; 
            margin: 0 auto; 
            padding: 20px; 
        }
        .session-data {
            background: #e8f5e8;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            border-left: 5px solid #4caf50;
        }
        .nav-links {
            margin: 20px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        .nav-links a {
            color: #3498db;
            text-decoration: none;
            margin: 0 10px;
            font-weight: bold;
        }
        .nav-links a:hover {
            text-decoration: underline;
        }
        .errors {
            background: #ffeaea;
            padding: 15px;
            border-radius: 8px;
            border-left: 5px solid #e74c3c;
            margin: 20px 0;
        }
        .api-data, .user-info, .cookie-info {
            background: #f0f8ff;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            border-left: 5px solid #3498db;
        }
        .cookie-info {
            background: #fff8e1;
            border-left: 5px solid #ff9800;
        }
        .noise-image {
            max-width: 300px;
            border: 1px solid #ccc;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h1>Добро пожаловать в систему записи на экскурсии</h1>
    
    <div class="nav-links">
        <a href="form.html">Заполнить форму</a> |
        <a href="view.php">Посмотреть все данные</a>
    </div>

    <?php if(isset($_SESSION['errors'])): ?>
        <div class="errors">
            <ul style="color:red;">
                <?php foreach($_SESSION['errors'] as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
            <?php unset($_SESSION['errors']); ?>
        </div>
    <?php endif; ?>

    <?php if(isset($_SESSION['name'])): ?>
        <div class="session-data">
            <p>Данные из сессии:</p>
            <ul>
                <li>Имя: <?= $_SESSION['name'] ?></li>
                <li>Дата экскурсии: <?= $_SESSION['excursion_date'] ?></li>
                <li>Маршрут: <?= $_SESSION['route'] ?></li>
                <li>Аудиогид: <?= $_SESSION['audio_guide'] ?></li>
                <li>Язык экскурсии: <?= $_SESSION['language'] ?></li>
                <li>Email: <?= $_SESSION['email'] ?></li>
            </ul>
        </div>
    <?php else: ?>
        <div class="session-data">
            <p>Данных пока нет.</p>
        </div>
    <?php endif; ?>

    <?php
    // Белый шум - всегда показываем изображение
    $colors = ['FFFFFF', 'FF0000', '00FF00', '0000FF', 'FFFF00', 'FF00FF', '00FFFF'];
    $randomColor = $colors[array_rand($colors)];
    $noiseUrl = "https://php-noise.com/noise.php?hex=$randomColor";
    
    echo "<div class='api-data'>";
    echo "<h3>Случайный шум:</h3>";
    echo "<p><strong>Цвет:</strong> #$randomColor</p>";
    echo "<img src='$noiseUrl' alt='Случайный шум' class='noise-image'>";
    echo "<p><small>Изображение генерируется сервисом <a href='https://php-noise.com/' target='_blank'>php-noise.com</a></small></p>";
    echo "</div>";
    ?>

    <?php
    // Информация о пользователе
    require_once 'UserInfo.php';
    $info = UserInfo::getInfo();
    echo "<div class='user-info'>";
    echo "<h3>Информация о пользователе:</h3>";
    foreach ($info as $key => $val) {
        echo htmlspecialchars($key) . ': ' . htmlspecialchars($val) . '<br>';
    }
    echo "</div>";
    ?>

    <?php
    // Информация о куки
    if (isset($_COOKIE['last_submission'])) {
        echo "<div class='cookie-info'>";
        echo "<h3>Информация о последней отправке формы:</h3>";
        echo "<p>Последняя отправка формы: " . htmlspecialchars($_COOKIE['last_submission']) . "</p>";
        echo "</div>";
    }
    ?>

    <div class="server-info">
        <h3>Информация о сервере:</h3>
        <p><strong>Время сервера:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
        <p><strong>Версия PHP:</strong> <?php echo phpversion(); ?></p>
        <p><strong>ID сессии:</strong> <?php echo session_id(); ?></p>
    </div>
</body>
</html>