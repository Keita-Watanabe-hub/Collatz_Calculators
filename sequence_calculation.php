<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Geometric Sequence Calculator</title>
</head>
<body>

<?php

class GeometricSequence {
    

    //first term,common ratio , number of terms(初項、公比、項数)
   
    
    private $first; // a
    private $ratio; // r
    private $number_terms; //n 
    //An = A1 * r^(n-1)　Formula
    public function __construct ($first,$ratio,$number_terms){
    $this->first=$first; $this->ratio=$ratio; $this->number_terms=$number_terms;
    }// constructor ended
    
    function get_Nth_term($n_term){
    //An = A1 * r^(n-1)
    
        return $this->first * pow($this->ratio, $n_term - 1);
    }//
    
    function get_sum($n){
        if ($this->ratio == 1) {
            // (公比が1の場合は単純に初項に項数を乗じる)
            return $this->first * $n;
        } else {
            // when i is not 1(公比が1ではない場合の和の公式)
            return $this->first * (1 - pow($this->ratio, $n)) / (1 - $this->ratio);
        }
    }
    
    }// end of this class (seq)
    
    /*$sequence = new GeometricSequence(1, 2, 10); // 初項1、公比2、項数10の等比数列
    echo "Nth term is below: ";
    echo( $sequence->get_Nth_term(5)."<br>");  // 5番目の項を出力
    echo "The sum of 1st term to Nth term is here: ";
    echo( $sequence->get_sum(5)); // 初項から5項の和を出力*/
    
    



// if we got post request,do it
// note : $_SERVER（サーバー変数）は連想配列として、$_SERVER['キー名']
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get user input..
    $first = $_POST['first'];
    $ratio = $_POST['ratio'];
    $number_terms = $_POST['number_terms'];
    $n_term = $_POST['n_term'];

    // make a instance..
    $sequence = new GeometricSequence($first, $ratio, $number_terms);

    // output,print?
    echo "<p>Nth term is: " . $sequence->get_Nth_term($n_term) . "</p>";
    echo "<p>The sum of the 1st to Nth term is: " . $sequence->get_sum($n_term) . "</p>";
}
?>


<form method="post">
    Initial term : <input type="number" name="first" required><br>
    Common ratio : <input type="number" name="ratio" required step="any"><br>
    Number of terms : <input type="number" name="number_terms" required><br>
    Term to find : <input type="number" name="n_term" required><br>
    <input type="submit" value="Calculate">
</form>

</body>
</html>
