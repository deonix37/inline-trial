<?php

$db = new PDO('sqlite:' . __DIR__ . '/db.sqlite3');
$db->exec(file_get_contents(__DIR__ . '/schema.sqlite3.sql'));

$posts = json_decode(
    file_get_contents('https://jsonplaceholder.typicode.com/posts'), true,
);
$comments = json_decode(
    file_get_contents('https://jsonplaceholder.typicode.com/comments'), true,
);

$posts_stmt = $db->prepare(
    "INSERT INTO post (id, user_id, title, body)
    VALUES (:id, :userId, :title, :body);",
);
$comments_stmt = $db->prepare(
    "INSERT INTO comment (id, post_id, name, email, body)
    VALUES (:id, :postId, :name, :email, :body);",
);

foreach ($posts as $post) {
    $posts_stmt->execute($post);
}

foreach ($comments as $comment) {
    $comments_stmt->execute($comment);
}

echo sprintf(
    'Загружено %s записей и %s комментариев',
    count($posts), count($comments),
) . PHP_EOL;
