<?php

function logRequest()
{
    // Retrieve the request details
    $requestData = array(
        'Timestamp' => date('Y-m-d H:i:s'),
        'URL' => $_SERVER['REQUEST_URI'],
        'Method' => $_SERVER['REQUEST_METHOD'],
        'IP Address' => $_SERVER['REMOTE_ADDR'],
        'User Agent' => $_SERVER['HTTP_USER_AGENT'],
        'GET Data' => $_GET,
        'POST Data' => $_POST
    );

    // Convert the request data to a JSON string
    $logData = json_encode($requestData);

    // Append the log data to a file (e.g., log.txt)
    file_put_contents('log.txt', $logData . PHP_EOL, FILE_APPEND);
}

// Call the logRequest() function to log the current request
logRequest();

?>
