<?php
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // List of allowed extensions

if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $fileName = $_FILES['file']['name'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (in_array($fileExtension, $allowedExtensions)) {
        // File extension is allowed
        // Process the file upload or save it to a specific location
        move_uploaded_file($_FILES['file']['tmp_name'], '/path/to/upload/directory/' . $fileName);

        echo 'File uploaded successfully.';
    } else {
        echo 'Invalid file extension. Only the following file types are allowed: ' . implode(', ', $allowedExtensions);
    }
}
?>
