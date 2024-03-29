<?php
function collatz_formula($number){
    // Ensure the number is positive.
    if($number <= 0){
        return null;
    }

    $max_value = $number; 
    $count = 0;
    $sequence = array($number); // Initialize an array to hold the sequence values.

    // Calculate the sequence until it reaches 1.
    while($number != 1){
        if($number % 2 == 0){
            $number /= 2;
        } else {
            $number = 3 * $number + 1;
        }

        // Add the current number to the sequence array.
        $sequence[] = $number;

        // Update the max_value if the current number is greater.
        if($number > $max_value){
            $max_value = $number;
        }

        $count++;
        
    }// end of while
   
     // Print the number of calculations for this value.
    // echo "how many calculation has done to get this: " . $count ." times". "<br>";
    

   // $result = array('max_value' => $max_value, 'count' => $count); :: For debug yo
    //print_r($result);

    $result = array('max_value' => $max_value, 'count' => $count);
foreach ($result as $key => $value) {
   echo $key . ": " . $value . "\n";
    
 }echo" :Sequences: "; 

    // Print all values in the sequence.
   foreach($sequence as $value){
        echo $value . "  ";
    }
    echo "<br>"; 

    // Return the max value and the count of iterations.
    

    return array('max_value' => $max_value, 'count' => $count);

}// end of function

// Example usage: Test with a single number and print all values.
echo "Test: ";
collatz_formula(6);
?>
