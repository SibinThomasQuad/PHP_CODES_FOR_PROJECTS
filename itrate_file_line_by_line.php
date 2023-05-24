<?php

$filename = 'example.txt'; // Replace with the path to your file

// Open the file for reading
$file = fopen($filename, 'r');

if ($file) {
    // Read and process each line until the end of the file is reached
    while (($line = fgets($file)) !== false) {
        // Process the current line
        echo $line; // Replace this with your desired processing logic
        
        // You can perform any desired operations on each line here
        
        // Example: Convert each line to uppercase
        // echo strtoupper($line);
    }
    
    // Close the file
    fclose($file);
} else {
    echo "Failed to open the file.";
}

?>
