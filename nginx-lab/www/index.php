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
    </style>
</head>
<body>
    <h1>Добро пожаловать в систему записи на экскурсии</h1>
    
    <div class="nav-links">
        <a href="form.html">Заполнить форму</a> |
        <a href="view.php">Посмотреть все данные</a>
    </div>

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

    <div class="server-info">
        <h3>Информация о сервере:</h3>
        <p><strong>Время сервера:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
        <p><strong>Версия PHP:</strong> <?php echo phpversion(); ?></p>
        <p><strong>ID сессии:</strong> <?php echo session_id(); ?></p>
    </div>
</body>
</html>