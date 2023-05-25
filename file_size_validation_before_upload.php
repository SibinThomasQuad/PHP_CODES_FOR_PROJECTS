<?php
// Define the maximum allowed file size in bytes (e.g., 5MB)
$maxFileSize = 5 * 1024 * 1024; // 5MB in bytes

// Check if a file was uploaded
if (isset($_FILES['file'])) {
    $uploadedFile = $_FILES['file'];

    // Check if there was no file upload error
    if ($uploadedFile['error'] === UPLOAD_ERR_OK) {
        $fileSize = $uploadedFile['size'];

        // Check if the file size is within the permitted limit
        if ($fileSize <= $maxFileSize) {
            // Process the uploaded file
            // ...

            echo 'File uploaded successfully!';
        } else {
            echo 'File size exceeds the permitted limit.';
        }
    } else {
        echo 'Error uploading file: ' . $uploadedFile['error'];
    }
}
?>

<!-- HTML form for file upload -->
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" value="Upload">
</form>
