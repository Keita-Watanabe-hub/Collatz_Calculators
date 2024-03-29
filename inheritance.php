<?php

class collatzCalculator {
    // private properties for storing iteration stats
    private $max_iterations;
    private $min_iterations;
    private $max_iteration_value;
    private $min_iteration_value;
    protected $results = []; // Protected so it can be accessed from a subclass

    // Constructor initializes properties
    public function __construct() {
        $this->max_iterations = 0;
        $this->min_iterations = PHP_INT_MAX;
        $this->max_iteration_value = 0;
        $this->min_iteration_value = PHP_INT_MAX;
    }

    // Calculates Collatz sequence for a range of numbers
    public function calculate_range($start, $end) {
        $end = min($end, 1000000); // Limit end to 1,000,000 to prevent excessive processing
        for ($i = $start; $i <= $end; $i++) {
            $result = $this->collatz_formula($i); // Calculate Collatz sequence for each number

            // Update max and min iterations and their corresponding values if necessary
            if ($result['count'] > $this->max_iterations) {
                $this->max_iterations = $result['count'];
                $this->max_iteration_value = $i;
            }
            if ($result['count'] < $this->min_iterations) {
                $this->min_iterations = $result['count'];
                $this->min_iteration_value = $i;
            }
            $this->results[$i] = $result; // Store result for this number
        }
    }

    // Calculates the Collatz sequence for a single number
    private function collatz_formula($number) {
        if ($number <= 0) return null; // Validate input
        $max_value = $number; // Track highest number in sequence
        $count = 0; // Count of iterations
        $sequence = [$number]; // Store the sequence starting with the initial number

        // Generate the sequence
        while ($number != 1) {
            if ($number % 2 == 0) {
                $number /= 2;
            } else {
                $number = 3 * $number + 1;
            }
            $sequence[] = $number; // Add new number to sequence
            if ($number > $max_value) {
                $max_value = $number; // Update max value if current number is higher
            }
            $count++;
        }
        // Return sequence details
        return [
            'max_value' => $max_value,
            'count' => $count,
            'sequence' => $sequence
        ];
    }

    // Display results in HTML format
    public function displayResults() {
        echo "Maximum Iterations: {$this->max_iterations} (Number: {$this->max_iteration_value})<br>";
        echo "Minimum Iterations: {$this->min_iterations} (Number: {$this->min_iteration_value})<br>";

        foreach ($this->results as $number => $result) {
            echo "Number: {$number} - Max Value: {$result['max_value']} - Iterations: {$result['count']} - Sequence: ";
            foreach ($result['sequence'] as $value) {
                echo $value . " ";
            }
            echo "<br>";
        }
    }
}

class collatzStatsCalculator extends collatzCalculator {
    private $iteration_histogram = []; // Stores histogram data

    // Constructor with additional property initialization
    public function __construct() {
        parent::__construct(); // Call parent constructor, overide
        $this->iteration_histogram = []; // Initialize histogram
    }

    // Generates histogram data based on collatz results
    public function generateHistogram() {
        foreach ($this->results as $result) {
            $count = $result['count']; // Get iteration count
            if (isset($this->iteration_histogram[$count])) {
                $this->iteration_histogram[$count]++; // Increment existing entry
            } else {
                $this->iteration_histogram[$count] = 1; // Create new entry
            }
        }
    }

    // Returns histogram data
    public function getHistogramData() {
        return $this->iteration_histogram;
    }

    // Display results (overrides parent method)
    public function displayResults() {
        parent::displayResults(); // Call parent method to display basic results
        // Histogram display can be added here if needed
    }
}
?>
