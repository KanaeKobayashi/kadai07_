<?php
$file = 'data/responses.txt';

if (file_exists($file)) {
  $responses = file($file, FILE_IGNORE_NEW_LINES);

  // 評価ごとの回答数をカウント
  $ratingsCount = array();
  foreach ($responses as $response) {
    $fields = explode('|', $response);
    $rating = intval($fields[4]);

    if (isset($ratingsCount[$rating])) {
      $ratingsCount[$rating]++;
    } else {
      $ratingsCount[$rating] = 1;
    }
  }

  // グラフ用のデータ準備
  $labels = range(1, 5);
  $data = array();
// $labelsの順序に合わせて$dataを設定
foreach ($labels as $label) {
  if (isset($ratingsCount[$label])) {
    $data[] = $ratingsCount[$label];
  } else {
    $data[] = 0;
  }
}


} else {
  echo 'まだアンケートがありません。';
}
$labels = range(1, 5);
?>

<!DOCTYPE html>
<html lang="jp">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アンケート集計結果</title>
  <link rel="stylesheet" href="totaling.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
</head>
<body>
  <div class="main">
  <h1>⭐️星の数集計結果</h1>
  
  <?php if (isset($labels) && isset($data)) : ?>
    <canvas id="chart"></canvas>
  <?php else : ?>
    <p>まだアンケートがありません。</p>
  <?php endif; ?>
  
  <a href="index.php" class="back-button">戻る</a>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var ctx = document.getElementById('chart').getContext('2d');
      var chart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: <?php echo json_encode($labels); ?>,
          datasets: [{
            label: '回答数',
            data: <?php echo json_encode($data); ?>,
            backgroundColor: 'rgba(60, 182, 182, 0.6)'
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              precision: 0
            }
          }
        }
      });
    });
  </script>
</body>
</html>
