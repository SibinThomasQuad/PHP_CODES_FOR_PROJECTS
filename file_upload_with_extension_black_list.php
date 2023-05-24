<?php

// Define the blacklisted file extensions
$blacklistedExtensions = array('php', 'exe', 'sh');

// Function to get the file extension
function getFileExtension($filename) {
  return pathinfo($filename, PATHINFO_EXTENSION);
}

// Function to check if a file extension is blacklisted
function isBlacklistedExtension($extension) {
  global $blacklistedExtensions;
  return in_array($extension, $blacklistedExtensions);
}

// Example usage in file upload handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_FILES['file'])) {
    $uploadedFile = $_FILES['file'];

    $filename = $uploadedFile['name'];
    $tempFilePath = $uploadedFile['tmp_name'];
    $fileExtension = getFileExtension($filename);

    if (isBlacklistedExtension($fileExtension)) {
      // Blacklisted extension found
      echo "Error: File extension not allowed.";
    } else {
      // Move the uploaded file to the desired location
      $destinationPath = "uploads/" . $filename;
      move_uploaded_file($tempFilePath, $destinationPath);
      echo "File uploaded successfully.";
    }
  }
}

?>
