<?php
//初項、公比、および項数
class GeometricSequence{

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
        // 公比が1の場合は単純に初項に項数を乗じる
        return $this->first * $n;
    } else {
        // when i is not 1(公比が1ではない場合の和の公式)
        return $this->first * (1 - pow($this->ratio, $n)) / (1 - $this->ratio);
    }
}

}// end of this class (seq)

$sequence = new GeometricSequence(1, 2, 10); // 初項1、公比2、項数10の等比数列
echo "Nth term is below: ";
echo( $sequence->get_Nth_term(5)."<br>");  // 5番目の項を出力
echo "The sum of 1st term to Nth term is here: ";
echo( $sequence->get_sum(5)); // 初項から5項の和を出力


?>