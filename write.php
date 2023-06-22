<?php
// フォームデータの受け取り
$name = $_POST['name'];
$email = $_POST['email'];
$bookTitle = $_POST['bookTitle'];
$author = $_POST['author'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];

// データの保存
$data = $name . '|' . $email . '|' . $bookTitle . '|' . $author . '|' . $rating . '|' . $comment . PHP_EOL;
$file = 'data/responses.txt';
file_put_contents($file, $data, FILE_APPEND | LOCK_EX);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="write.css">
</head>
<body>
<div class="message">
    <p class="comment">アンケートが送信されました。<br> ありがとうございました！<br></p>
    <a href="index.php" class="back-button">戻る<br></a>
    <a href="totalling.php" class="back-button">集計結果を表示する<br></a>
    <a href="result.php" class="back-button">回答一覧</a>
  </div>
</body>
</html>

