<?php
function read_file($file_path) {
    /**
     * Read the contents of a file and return as a string.
     */
    return file_get_contents($file_path);
}

function write_file($file_path, $content) {
    /**
     * Write the given content to a file.
     */
    file_put_contents($file_path, $content);
}

function append_to_file($file_path, $content) {
    /**
     * Append the given content to the end of a file.
     */
    file_put_contents($file_path, $content, FILE_APPEND);
}

function copy_file($source_path, $destination_path) {
    /**
     * Copy a file from the source path to the destination path.
     */
    copy($source_path, $destination_path);
}

function delete_file($file_path) {
    /**
     * Delete a file from the file system.
     */
    unlink($file_path);
}

// Example usage
$file_path = 'example.txt';

// Read the contents of a file
$content = read_file($file_path);
echo $content;

// Write content to a file
$new_content = 'This is the new content.';
write_file($file_path, $new_content);

// Append content to a file
$appended_content = 'This is the appended content.';
append_to_file($file_path, $appended_content);

// Copy a file to a new location
$destination_path = 'copy_example.txt';
copy_file($file_path, $destination_path);

// Delete a file
delete_file($file_path);
?>
