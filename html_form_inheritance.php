<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Collatz Calculator</title>
</head>
<body>
    <form method="post">
        <label for="start">Start Value:</label>
        <input type="number" id="start" name="start" required>

        <label for="end">End Value:</label>
        <input type="number" id="end" name="end" required max="1000000">
        
        <input type="submit" value="Start Calculation">
    </form>


<?php

require_once '/Applications/XAMPP/xamppfiles/htdocs/php/inheritance.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start = $_POST['start'];
    $end = $_POST['end'];

    $collatz = new collatzStatsCalculator();
    $collatz->calculate_range($start, $end);
    $collatz->generateHistogram();
    $collatz->displayResults();
}

?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>

<canvas id="collatzHistogram" width="400" height="400"></canvas>

<script>
// PHPからのデータをJavaScriptの変数に格納
var histogramData = <?php echo json_encode($collatz->getHistogramData()); ?>;
var labels = Object.keys(histogramData);// ラベル（キー）の抽出
var data = Object.values(histogramData); // データの抽出（値）

// Chart.jsでヒストグラムを描画
var ctx = document.getElementById('collatzHistogram').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,// x軸のラベル

        datasets: [{
            label: 'Frequency',
            data: data,// y軸のデータ
            backgroundColor: 'rgba(0, 123, 255, 0.5)',
            borderColor: 'rgba(0, 123, 255, 1)',
            borderWidth: 1,
            barThickness: 15, // バーの厚さを設定
            categoryPercentage: 0.8, // カテゴリー間のスペースの割合
            barPercentage: 0.9 // バーの幅の割合
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                min: 0 
            }
        }
    }
});
</script>


</body>
</html>
