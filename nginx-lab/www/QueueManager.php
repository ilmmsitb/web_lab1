<?php
namespace App;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class QueueManager {
    private $channel;
    private $connection;
    private $queueName = 'news_queue';

    public function __construct() {
        $this->connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
        $this->channel = $this->connection->channel();
        $this->channel->queue_declare($this->queueName, false, true, false, false);
    }

    public function publish($data) {
        $msg = new AMQPMessage(
            json_encode($data, JSON_UNESCAPED_UNICODE), 
            ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]
        );
        $this->channel->basic_publish($msg, '', $this->queueName);
        echo "✅ Сообщение отправлено в очередь: " . json_encode($data) . "\n";
    }

    public function consume(callable $callback) {
        echo "👷 Обработчик запущен. Ожидание сообщений...\n";

        $this->channel->basic_consume(
            $this->queueName, 
            '', 
            false, 
            true, 
            false, 
            false, 
            function($msg) use ($callback) {
                $data = json_decode($msg->body, true);
                echo "📥 Получено сообщение: " . $msg->body . "\n";
                $callback($data);
            }
        );

        while ($this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }

    public function __destruct() {
        if ($this->channel) {
            $this->channel->close();
        }
        if ($this->connection) {
            $this->connection->close();
        }
    }
}
?>