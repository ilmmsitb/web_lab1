<?php
require 'vendor/autoload.php';

use App\QueueManager;

echo "========================================\n";
echo "👷 Обработчик новостей RabbitMQ запущен\n";
echo "========================================\n";
echo "Ожидание сообщений в очереди...\n\n";

try {
    $queueManager = new QueueManager();
    
    $queueManager->consume(function($data) {
        echo "🎯 Начало обработки новости: {$data['title']}\n";
        
        // Имитация обработки (анализ, модерация, индексация)
        echo "⏳ Обработка новости...\n";
        sleep(3); // Имитация долгой обработки
        
        // Сохраняем результат
        $result = [
            'processed_at' => date('Y-m-d H:i:s'),
            'original_data' => $data,
            'status' => 'processed',
            'worker_pid' => getmypid()
        ];
        
        file_put_contents('processed_news.log', 
            json_encode($result, JSON_UNESCAPED_UNICODE) . PHP_EOL, 
            FILE_APPEND
        );
        
        echo "✅ Новость обработана: {$data['title']}\n";
        echo "📊 Результат сохранен в processed_news.log\n";
        echo "---\n";
    });
    
} catch (Exception $e) {
    echo "❌ Критическая ошибка: " . $e->getMessage() . "\n";
    echo "Трассировка: " . $e->getTraceAsString() . "\n";
}
?>