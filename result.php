<?php
$file = 'data/responses.txt';

if (file_exists($file)) {
    $responses = file($file, FILE_IGNORE_NEW_LINES);
  
    // 表の開始を表示
    echo '<table border="1">';
    echo '<tr><th>名前</th><th>Eメール</th><th>本のタイトル</th><th>著者</th><th>評価</th><th>コメント</th></tr>';
  
    foreach ($responses as $response) {
        $fields = explode('|', $response);
        $name = $fields[0];
        $email = $fields[1];
        $bookTitle = $fields[2];
        $author = $fields[3];
        $rating = $fields[4];
        $comment = $fields[5];
  
        // データの表示
        echo '<tr>';
        echo '<td>' . $name . '</td>';
        echo '<td>' . $email . '</td>';
        echo '<td>' . $bookTitle . '</td>';
        echo '<td>' . $author . '</td>';        
        echo '<td>' . $rating . '</td>';
        echo '<td>' . $comment . '</td>';
        echo '</tr>';
    }
    // 表の終了を表示
    echo '</table>';
} else {
    echo 'まだアンケートがありません。';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="result.css">
</head>
<body>
<a href="index.php" class="back-button">戻る</a>
<a href="totalling.php" class="back-button">集計結果を表示する</a>
</body>
</html>



