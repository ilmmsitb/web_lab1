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
        .menu { 
            background: #f5f5f5; 
            padding: 20px; 
            border-radius: 10px; 
            margin-bottom: 20px; 
        }
        .btn { 
            display: inline-block; 
            padding: 10px 20px; 
            background: #3498db; 
            color: white; 
            text-decoration: none; 
            border-radius: 5px; 
            margin: 5px; 
        }
        .session-data {
            background: #e8f5e8;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            border-left: 5px solid #4caf50;
        }
        .field {
            margin: 8px 0;
            padding: 8px;
            background: white;
            border-radius: 4px;
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
        <h3>✅ Данные из сессии:</h3>
        <ul>
            <li><strong>Имя:</strong> <?= $_SESSION['name'] ?></li>
            <li><strong>Дата экскурсии:</strong> <?= $_SESSION['excursion_date'] ?></li>
            <li><strong>Маршрут:</strong> <?= $_SESSION['route'] ?></li>
            <li><strong>Аудиогид:</strong> <?= $_SESSION['audio_guide'] ?></li>
            <li><strong>Язык экскурсии:</strong> <?= $_SESSION['language'] ?></li>
            <li><strong>Email:</strong> <?= $_SESSION['email'] ?></li>
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