<?php

class collatzCalculator{

private $max_iterations;
private $min_iterations;
private $max_iteration_value;
private $min_iteration_value;
private $results = []; // store result to show sequence?
// constructor
public function __construct(){
$this->max_iterations=0;
$this->min_iterations=PHP_INT_MAX;
$this->max_iteration_value=0;
$this->min_iteration_value=0;
}

public function calculate_range($start,$end){
$end=min($end,1000000); // limit the end until to 1000000
for($i=$start;$i<=$end;$i++){
    $result=$this->collatz_formula($i);

if($result['count']>$this->max_iterations){
    $this->max_iterations=$result['count'];
    $this->max_iteration_value=$i;
}
if($result['count']<$this->min_iterations){
    $this->min_iterations=$result['count'];
    $this->min_iteration_value=$i;
}
// here to have sequence of collatz result as array 
  
    $this->results[$i] = $result; // 計算結果を配列に保存


}// end of for loop

}// end of range Function




private function collatz_formula($number) {
// check positive or not
        if($number<=0){
            return null;
        }
        $max_value=$number;
        $count=0;
        $sequence=[$number];
// continues till reach to 1 then done
    while($number !=1){

        if($number%2==0){
            $number/=2; // when it is even
        }
    else{
        $number=3*$number+1; // when it is odd
    }
    //array?
    $sequence[]=$number;
    if($number>$max_value){
        $max_value=$number;// here I want to update the maxvalue if $number is larger
    }
    $count++;
    }// end of while
// associative array, i felt like its more useful than mult dim

    return[
'max_value'=>$max_value,
'count'=>$count,
'sequence'=>$sequence
    ];

}// end of collatz formu

public function displayResults(){
    echo "Maximum Iterations: 
    {$this->max_iterations}(Number:
    {$this->max_iteration_value})<br>";

    echo "Minimum Iterations: 
    {$this->min_iterations}(Number:
    {$this->min_iteration_value})<br>";

    foreach ($this->results as $number => $result) {
        echo "max_value: {$result['max_value']} count: {$result['count']} :Sequences: ";
        foreach ($result['sequence'] as $value) {
            echo $value . " ";
        }
        echo "<br>";
    }

}// end of display 



}// end of claas














?>