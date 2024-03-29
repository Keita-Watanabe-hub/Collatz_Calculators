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

 require_once '/Applications/XAMPP/xamppfiles/htdocs/php/collatz_function_oop_classpart.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start = $_POST['start'];
    $end = $_POST['end'];

    // collatzCalculatorのinstance and do computation
    $collatz = new collatzCalculator();
    $collatz->calculate_range($start, $end);
    $collatz->displayResults();
}
?>
</body>
</html>
