<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Все данные</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .data-list {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }
        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h2>Все сохранённые данные:</h2>
    <div class="data-list">
        <ul>
            <?php
            if(file_exists("data.txt")){
                $lines = file("data.txt", FILE_IGNORE_NEW_LINES);
                foreach($lines as $line){
                    list($name, $excursion_date, $route, $audio_guide, $language, $email) = explode(";", $line);
                    echo "<li><strong>$name</strong> - Дата: $excursion_date, Маршрут: $route, Аудиогид: $audio_guide, Язык: $language, Email: $email</li>";
                }
            } else {
                echo "<li>Данных нет</li>";
            }
            ?>
        </ul>
    </div>
    <a href="index.php" class="back-link">На главную</a>
</body>
</html>