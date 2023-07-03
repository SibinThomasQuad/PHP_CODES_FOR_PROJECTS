<?php

// Function to sanitize user input for safe use in SQL queries
function sanitizeInput($input) {
    // Remove harmful characters and escape special characters
    $sanitizedInput = trim($input);
    $sanitizedInput = stripslashes($sanitizedInput);
    $sanitizedInput = htmlspecialchars($sanitizedInput, ENT_QUOTES, 'UTF-8');
    
    return $sanitizedInput;
}

// Function to sanitize user input for safe use in HTML output
function sanitizeOutput($output) {
    // Convert special characters to HTML entities
    $sanitizedOutput = htmlspecialchars($output, ENT_QUOTES, 'UTF-8');
    
    return $sanitizedOutput;
}

// Function to sanitize URL parameters
function sanitizeURLParameter($parameter) {
    // Filter and sanitize the URL parameter
    $sanitizedParameter = filter_var($parameter, FILTER_SANITIZE_STRING);
    $sanitizedParameter = urlencode($sanitizedParameter);
    
    return $sanitizedParameter;
}

?>
