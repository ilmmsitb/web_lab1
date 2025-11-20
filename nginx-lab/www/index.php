<?php
require 'vendor/autoload.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Система управления новостями с очередями</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .form-group { margin: 15px 0; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, textarea, select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        .log { background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0; }
    </style>
</head>
<body>
    <h1>📰 Система управления новостями с RabbitMQ</h1>
    
    <div class="form-group">
        <h2>Добавить новость в очередь</h2>
        <form action="send.php" method="POST">
            <label>Заголовок:</label>
            <input type="text" name="title" required value="Новая важная новость">
            
            <label>Содержание:</label>
            <textarea name="content" rows="4" required>Это тестовое содержание новости для обработки через очередь сообщений.</textarea>
            
            <label>Категория:</label>
            <select name="category">
                <option value="политика">Политика</option>
                <option value="спорт">Спорт</option>
                <option value="технологии">Технологии</option>
                <option value="культура">Культура</option>
            </select>
            
            <label>Автор:</label>
            <input type="text" name="author" required value="Редакция">
            
            <button type="submit">📨 Отправить в очередь</button>
        </form>
    </div>

    <div class="form-group">
        <h2>Статус системы</h2>
        <div class="log">
            <p><strong>RabbitMQ:</strong> <a href="http://localhost:15672" target="_blank">Панель управления</a></p>
            <p><strong>Очередь:</strong> news_queue</p>
            <p><strong>Для запуска обработчика выполните:</strong></p>
            <code>docker exec -it lab7_php php worker.php</code>
        </div>
    </div>

    <div class="form-group">
        <h2>Лог обработки</h2>
        <div class="log">
            <?php
            if (file_exists('processed_news.log')) {
                echo "<pre>" . htmlspecialchars(file_get_contents('processed_news.log')) . "</pre>";
            } else {
                echo "<p>Лог пуст. Сообщения ещё не обрабатывались.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>