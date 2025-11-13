<?php
namespace App;

class ElasticNews
{
    private $client;
    private $index = 'news';

    public function __construct()
    {
        $this->client = ClientFactory::make('http://elasticsearch:9200/');
    }

    // Создание индекса для новостей
    public function createIndex()
    {
        try {
            $mapping = [
                'mappings' => [
                    'properties' => [
                        'title' => ['type' => 'text'],
                        'content' => ['type' => 'text'],
                        'category' => ['type' => 'keyword'],
                        'author' => ['type' => 'keyword'],
                        'published_date' => ['type' => 'date'],
                        'tags' => ['type' => 'keyword'],
                        'views' => ['type' => 'integer']
                    ]
                ]
            ];

            $response = $this->client->put($this->index, [
                'json' => $mapping
            ]);
            
            return "✅ Индекс '{$this->index}' создан успешно!";
        } catch (\Exception $e) {
            return "❌ Ошибка создания индекса: " . $e->getMessage();
        }
    }

    // Добавление новости
    public function addNews($id, $data)
    {
        try {
            $response = $this->client->put("{$this->index}/_doc/{$id}", [
                'json' => $data
            ]);
  
            $this->client->post("{$this->index}/_refresh");
            
            return "✅ Новость '{$data['title']}' добавлена с ID: {$id}";
        } catch (\Exception $e) {
            return "❌ Ошибка добавления новости: " . $e->getMessage();
        }
    }

    // Поиск новостей
    public function searchNews($query)
    {
        try {
            $searchBody = [
                'query' => [
                    'multi_match' => [
                        'query' => $query,
                        'fields' => ['title', 'content', 'tags']
                    ]
                ],
                'sort' => [
                    ['published_date' => ['order' => 'desc']]
                ]
            ];

            $response = $this->client->get("{$this->index}/_search", [
                'json' => $searchBody
            ]);

            $results = json_decode($response->getBody()->getContents(), true);
            return $this->formatSearchResults($results);
        } catch (\Exception $e) {
            return "❌ Ошибка поиска: " . $e->getMessage();
        }
    }

    // Поиск по категории
    public function searchByCategory($category)
    {
        try {
            $searchBody = [
                'query' => [
                    'term' => [
                        'category' => $category
                    ]
                ]
            ];

            $response = $this->client->get("{$this->index}/_search", [
                'json' => $searchBody
            ]);

            $results = json_decode($response->getBody()->getContents(), true);
            return $this->formatSearchResults($results);
        } catch (\Exception $e) {
            return "❌ Ошибка поиска по категории: " . $e->getMessage();
        }
    }

    // Получить все новости
    public function getAllNews()
    {
        try {
            $searchBody = [
                'query' => [
                    'match_all' => new \stdClass()
                ],
                'sort' => [
                    ['published_date' => ['order' => 'desc']]
                ],
                'size' => 20
            ];

            $response = $this->client->get("{$this->index}/_search", [
                'json' => $searchBody
            ]);

            $results = json_decode($response->getBody()->getContents(), true);
            return $this->formatSearchResults($results);
        } catch (\Exception $e) {
            return "❌ Ошибка получения новостей: " . $e->getMessage();
        }
    }

    // Форматирование результатов поиска
    private function formatSearchResults($results)
    {
        if (empty($results['hits']['hits'])) {
            return "📭 Новости не найдены";
        }

        $formatted = "🔍 Найдено новостей: {$results['hits']['total']['value']}\n\n";
        
        foreach ($results['hits']['hits'] as $hit) {
            $news = $hit['_source'];
            $formatted .= "📰 <strong>{$news['title']}</strong>\n";
            $formatted .= "📝 " . substr($news['content'], 0, 100) . "...\n";
            $formatted .= "🏷️ Категория: {$news['category']} | 👤 Автор: {$news['author']}\n";
            $formatted .= "📅 Дата: {$news['published_date']} | 👁️ Просмотры: {$news['views']}\n";
            $formatted .= "🔖 Теги: " . implode(', ', $news['tags']) . "\n";
            $formatted .= "---\n";
        }

        return $formatted;
    }

    // Получить статистику индекса
    public function getStats()
    {
        try {
            $response = $this->client->get("{$this->index}/_stats");
            $stats = json_decode($response->getBody()->getContents(), true);
            
            $docCount = $stats['indices'][$this->index]['total']['docs']['count'] ?? 0;
            $size = $stats['indices'][$this->index]['total']['store']['size_in_bytes'] ?? 0;
            
            return "📊 Статистика индекса '{$this->index}':\n" .
                   "📄 Документов: {$docCount}\n" .
                   "💾 Размер: " . round($size / 1024 / 1024, 2) . " MB";
        } catch (\Exception $e) {
            return "❌ Ошибка получения статистики: " . $e->getMessage();
        }
    }
}