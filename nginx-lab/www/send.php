<?php
require 'vendor/autoload.php';

use App\QueueManager;

// Включим логирование для отладки
file_put_contents('send.log', date('Y-m-d H:i:s') . " - Отправка сообщения\n", FILE_APPEND);

try {
    $queueManager = new QueueManager();
    
    $newsData = [
        'id' => uniqid(),
        'title' => $_POST['title'] ?? 'Без заголовка',
        'content' => $_POST['content'] ?? 'Без содержания',
        'category' => $_POST['category'] ?? 'общее',
        'author' => $_POST['author'] ?? 'Аноним',
        'timestamp' => date('Y-m-d H:i:s'),
        'status' => 'queued'
    ];
    
    $queueManager->publish($newsData);
    
    echo "<h1>✅ Новость отправлена в очередь!</h1>";
    echo "<pre>" . json_encode($newsData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "</pre>";
    echo "<p><a href='index.php'>Вернуться назад</a></p>";
    
} catch (Exception $e) {
    echo "<h1>❌ Ошибка отправки</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<p><a href='index.php'>Вернуться назад</a></p>";
}
?>