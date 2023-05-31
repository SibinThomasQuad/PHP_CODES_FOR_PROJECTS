<?php
function postData($url, $data) {
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        $error = curl_error($curl);
        // Handle the error appropriately
    }

    curl_close($curl);

    return $response;
}

function getData($url) {
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        $error = curl_error($curl);
        // Handle the error appropriately
    }

    curl_close($curl);

    return $response;
}

// Example usage
$url = 'https://example.com/api';

// POST data
$data = array(
    'param1' => 'value1',
    'param2' => 'value2'
);

// Send POST request
$response = postData($url, $data);

// Process the response from the API
// $response variable holds the response data

// Send GET request
$response = getData($url);

// Process the response from the API
// $response variable holds the response data

?>
