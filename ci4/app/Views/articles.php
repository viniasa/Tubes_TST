<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #3498db;
            padding: 20px;
        }
        .article-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 20px;
        }
        .article-box {
            width: 300px;
            margin: 15px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .article-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
        }
        .article-box img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }
        .article-box h2 {
            font-size: 18px;
            margin-top: 10px;
            color: #333;
        }
        .article-box p {
            font-size: 14px;
            color: #555;
            margin: 10px 0;
        }
        .article-box a {
            display: inline-block;
            padding: 8px 15px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .article-box a:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <h1>Articles</h1>
    <div class="article-container">
        <?php foreach ($articles as $article): ?>
            <div class="article-box">
                <img src="<?= esc($article['image']) ?>" alt="<?= esc($article['title']) ?>">
                <h2><?= esc($article['title']) ?></h2>
                <p><?= esc($article['description']) ?></p>
                <a href="<?= esc($article['link']) ?>" target="_blank">Read More</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
