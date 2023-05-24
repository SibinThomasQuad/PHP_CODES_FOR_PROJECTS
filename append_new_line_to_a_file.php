<?php

$filename = 'example.txt'; // Replace with the path to your file
$newLine = "This is a new line.";

// Open the file in append mode
$file = fopen($filename, 'a');

if ($file) {
    // Append the new line to the file
    fwrite($file, $newLine . PHP_EOL);
    
    // Close the file
    fclose($file);
    echo "New line appended successfully.";
} else {
    echo "Failed to open the file.";
}

?>
