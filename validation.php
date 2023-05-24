<?php

// Function to check if a value is empty or null
function isEmpty($value) {
  return trim($value) === '';
}

// Function to check if a value is a valid number
function isNumber($value) {
  return is_numeric($value);
}

// Function to check if a value is a valid email address
function isEmail($value) {
  return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
}

// Function to check if a value is a valid URL
function isURL($value) {
  return filter_var($value, FILTER_VALIDATE_URL) !== false;
}

// Function to check if a value contains only alphabetic characters
function isAlpha($value) {
  return preg_match('/^[A-Za-z]+$/', $value) === 1;
}

// Function to check if a value contains only alphanumeric characters
function isAlphanumeric($value) {
  return preg_match('/^[0-9a-zA-Z]+$/', $value) === 1;
}

// Function to check if a value is a valid date
function isDate($value) {
  $date = DateTime::createFromFormat('Y-m-d', $value);
  return $date && $date->format('Y-m-d') === $value;
}

// Function to check if a value is a positive integer
function isPositiveInteger($value) {
  return filter_var($value, FILTER_VALIDATE_INT, array("options" => array("min_range" => 1))) !== false;
}

// Function to check if a value is a valid hexadecimal color code
function isHexColor($value) {
  return preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value) === 1;
}

// Function to check if a value is a valid phone number
function isPhoneNumber($value) {
  // Regular expression for phone number validation
  $phoneRegex = '/^\+?[0-9]{1,3}-?[0-9]{6,}$/';
  return preg_match($phoneRegex, $value) === 1;
}

// Example usage
$email = "test@example.com";
if (isEmail($email)) {
  echo "Email is valid.";
} else {
  echo "Email is not valid.";
}

// ...
// Add more input validation checks as needed

?>
