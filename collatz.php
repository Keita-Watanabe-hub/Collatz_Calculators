<!DOCTYPE html>
 <html lang = "en"> 
    <head> 
        <meta charset="UTF-8"> 
        <title>Collatz Calcuator</title> 
    </head> <body> 
        <form method ="post"> 
            <label for="start">Start value:</label> 
            <input type="number" id="start" name="start" required> 
            <label for="end">End Value:</label> 
            <input type="number" id="end" name="end" required max="1000000">
            <input type="submit" value="start calculation">
         </form>
<?php
// Include collatz_functions.php
//require 'collatz_functions.php';
require ('/Applications/XAMPP/xamppfiles/htdocs/php/collatz_functions.php');

// Process input from the form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start = $_POST['start'];
    $end = $_POST['end'];
    // here i can check again
    $end = min($end, 1000000);
    $max_iterations = 0;
    $min_iterations = PHP_INT_MAX;
    $max_iterations_number = 0;
    $min_iterations_number = 0;

    for ($i = $start; $i <= $end; $i++) {
        $result = collatz_formula($i);
      

        if ($result['count'] > $max_iterations) {
            $max_iterations = $result['count'];
            $max_iterations_number = $i;
        }
        if ($result['count'] < $min_iterations) {
            $min_iterations = $result['count'];
            $min_iterations_number = $i;
        }
    }

   
    echo "Maximum Iterations: {$max_iterations} (Number: {$max_iterations_number})<br>";
    echo "Minimum Iterations: {$min_iterations} (Number: {$min_iterations_number})<br>";

   
}
?>
</body> </html>