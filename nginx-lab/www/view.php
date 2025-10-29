<?php
require_once 'db.php';
require_once 'Excursion.php';

$excursion = new Excursion($pdo);
$all_excursions = $excursion->getAll();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Все данные</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1000px;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Все сохранённые данные (из MySQL):</h2>
    <div class="data-list">
        <?php if(!empty($all_excursions)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Дата экскурсии</th>
                        <th>Маршрут</th>
                        <th>Аудиогид</th>
                        <th>Язык</th>
                        <th>Email</th>
                        <th>Дата создания</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($all_excursions as $exc): ?>
                    <tr>
                        <td><?= $exc['id'] ?></td>
                        <td><?= htmlspecialchars($exc['name']) ?></td>
                        <td><?= $exc['excursion_date'] ?></td>
                        <td><?= htmlspecialchars($exc['route']) ?></td>
                        <td><?= $exc['audio_guide'] ?></td>
                        <td><?= htmlspecialchars($exc['language']) ?></td>
                        <td><?= htmlspecialchars($exc['email']) ?></td>
                        <td><?= $exc['created_at'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Данных в базе пока нет.</p>
        <?php endif; ?>
    </div>
    
    <a href="index.php" class="back-link">На главную</a>
</body>
</html>