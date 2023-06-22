<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームデータの受け取り、特殊文字をHTMLエンティティに変換
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    if (preg_match('/[^\\x01-\\x7E]/', $email)) {
        echo 'メールアドレスには全角文字を使用できません。';
        exit;
    }
    $bookTitle = isset($_POST['bookTitle'])? htmlspecialchars($_POST['bookTitle']) : '';
    $author = isset($_POST['author'])? htmlspecialchars($_POST['author']) : '';
    $rating = isset($_POST['rating']) ? htmlspecialchars($_POST['rating']) : '';
    $comment = isset($_POST['comment']) ? htmlspecialchars($_POST['comment']) : '';

    // 評価を整数に変換
    $rating = intval($rating);

    // データの保存
    $data = $name . '|' . $email . '|'. $bookTitle .'|' . $author .'|' . $rating . '|' . $comment . PHP_EOL;
    $file = 'data/responses.txt';
    file_put_contents($file, $data, FILE_APPEND | LOCK_EX);

    echo 'オススメの本が送信されました。ありがとうございました！';
}
?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommended Book</title>
    <link
  href="https://unpkg.com/sanitize.css"
  rel="stylesheet"
/>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header>
    <h1 class="title">あなたのオススメの本を教えてください</h1>
    </header>
    <form class="formWrapper" action="write.php" method="post">
        <label for="name">名前:</label>
            <input type="text" name="name" id="name" required><br>
  
            <label for="email">Eメール:</label>
            <input type="email" name="email" id="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required><br>
  
            <label for="bookTitle">おすすめの本のタイトル:</label>
            <input type="text" name="bookTitle" id="bookTitle" required><br>

            <label for="author">本の著者:</label>
            <input type="text" name="author" id="author" required><br>


        <label for="rating">オススメ度:</label>
            <div class="star-rating">
                <input type="radio" name="rating" id="rating5" value="5" required><label for="rating5"></label>
                <input type="radio" name="rating" id="rating4" value="4"><label for="rating4"></label>
                <input type="radio" name="rating" id="rating3" value="3"><label for="rating3"></label>
                <input type="radio" name="rating" id="rating2" value="2"><label for="rating2"></label>
                <input type="radio" name="rating" id="rating1" value="1"><label for="rating1"></label>
            </div>
  
        <label for="comment">オススメコメント:</label>
            <textarea name="comment" id="comment" required></textarea><br>
  
        <input type="submit" value="送信">
    </form>
  
    <script>
    const starRating = document.querySelector('.star-rating');
    const stars = starRating.querySelectorAll('input');

    stars.forEach((star) => {
        star.addEventListener('click', () => {
            const rating = star.value;
        });
    });
</script>

</body>
</html>
