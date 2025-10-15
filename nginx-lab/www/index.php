<?php
session_start();
?>
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
    </style>
</head>
<body>
    <h1>Добро пожаловать в систему записи на экскурсии</h1>
    
    <div class="menu">
        <h2>Меню:</h2>
        <a href="/form.html" class="btn">📝 Записаться на экскурсию</a>
    </div>

    <?php if (isset($_SESSION['name'])): ?>
    <div class="session-data">
        <h3>✅ Данные из сессии:</h3>
        <div class="field"><strong>Имя:</strong> <?php echo $_SESSION['name']; ?></div>
        <div class="field"><strong>Дата экскурсии:</strong> <?php echo $_SESSION['excursion_date']; ?></div>
        <div class="field"><strong>Маршрут:</strong> <?php echo $_SESSION['route']; ?></div>
        <div class="field"><strong>Аудиогид:</strong> <?php echo $_SESSION['audio_guide']; ?></div>
        <div class="field"><strong>Язык экскурсии:</strong> <?php echo $_SESSION['language']; ?></div>
        <div class="field"><strong>Email:</strong> <?php echo $_SESSION['email']; ?></div>
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