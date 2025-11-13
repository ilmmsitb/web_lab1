<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h1>Тест системы</h1>";

// Проверка автозагрузки
if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';
    echo "<p style='color:green'>✅ Autoload загружен</p>";
} else {
    echo "<p style='color:red'>❌ Autoload не найден</p>";
}

// Проверка Elasticsearch
try {
    $client = new GuzzleHttp\Client(['base_uri' => 'http://elasticsearch:9200/']);
    $response = $client->get('');
    echo "<p style='color:green'>✅ Elasticsearch доступен</p>";
} catch (Exception $e) {
    echo "<p style='color:red'>❌ Elasticsearch недоступен: " . $e->getMessage() . "</p>";
}
?>