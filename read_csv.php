<?php
// Path to the CSV file
$csvFile = 'path/to/your/file.csv';

// Open the CSV file
$handle = fopen($csvFile, 'r');

// Check if the file was opened successfully
if ($handle !== false) {
    // Read and process each line of the CSV file
    while (($data = fgetcsv($handle)) !== false) {
        // $data is an array containing the fields of the current CSV line
        // You can access individual fields using array indexing

        // Example: Accessing the first and second fields
        $field1 = $data[0];
        $field2 = $data[1];

        // Process the data as needed
        // ...

        // Example: Printing the fields
        echo "Field 1: $field1 | Field 2: $field2 <br>";
    }

    // Close the CSV file
    fclose($handle);
} else {
    // Error opening the CSV file
    echo 'Error opening the file.';
}
?>
