<?php
  if (isset($_GET['comment_body']) && strlen($_GET['comment_body']) >= 3) {
    $db = new PDO('sqlite:' . __DIR__ . '/db.sqlite3');

    $posts = $db->prepare(
      'SELECT post.title, comment.body as comment_body
      FROM comment
      JOIN post ON comment.post_id = post.id
      WHERE comment.body LIKE ?;',
    );
    $posts->execute(["%{$_GET['comment_body']}%"]);
  }
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Блог</title>
  <style>html {font-size: 24px;}</style>
</head>
<body>
  <div>
    <h2>Найти записи</h2>
    <form>
      <label>
        Текст комментария:
        <input name='comment_body' minlength="3" placeholder="lorem" required>
      </label>
      <button>Поиск</button>
    </form>
  </div>
  <?php if (isset($posts)): ?>
    <div>
      <h2>Результат по запросу <?= htmlspecialchars($_GET['comment_body']) ?>:</h2>
      <?php foreach ($posts as $post): ?>
        <div style="margin-bottom: 20px; padding: 10px; width: 500px; border: 1px solid black;">
          <div><b>Запись</b>: <?= $post['title'] ?></div>
          <div><b>Комментарий</b>: <?= $post['comment_body'] ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</body>
</html>
