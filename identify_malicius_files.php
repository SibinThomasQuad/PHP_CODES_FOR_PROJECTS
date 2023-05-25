<?php
function isMaliciousFile($filename)
{
    // Define a list of potentially malicious file extensions
    $maliciousExtensions = [
        'php', 'php3', 'php4', 'php5', 'phtml', // PHP script files
        'exe', 'bat', 'cmd', 'sh', 'com',        // Executable files
        'vbs', 'js', 'jar', 'vb', 'wsf',          // Script files
        'dll', 'sys',                             // System files
        'asp', 'aspx', 'ashx', 'asmx',            // Web-related files
        'cgi', 'pl', 'pm',                        // Perl-related files
        'py', 'pyc', 'pyd', 'pyo', 'pyw', 'pyz',  // Python-related files
        'rb', 'rbw',                              // Ruby-related files
        'jsp', 'jspx', 'jhtm', 'jhtml', 'jspx',   // Java-related files
    ];

    // Extract the file extension from the filename
    $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);

    // Check if the file extension is in the list of potentially malicious extensions
    if (in_array(strtolower($fileExtension), $maliciousExtensions)) {
        return true;
    }

    return false;
}

// Usage example
$filename = 'example.php';
if (isMaliciousFile($filename)) {
    echo 'Potentially malicious file!';
} else {
    echo 'File seems safe.';
}
?>
