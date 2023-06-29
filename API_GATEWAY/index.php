<?php

class ApiGateway
{
    private $baseURL;

    public function __construct($baseURL)
    {
        $this->baseURL = $baseURL;
    }

    public function handleRequest()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $_SERVER['PATH_INFO'];
        $targetURL = $this->baseURL . $path;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $targetURL);
        
        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
        }
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        header('Content-Type: application/json');
        http_response_code($httpCode);
        
        echo $response;
        
        curl_close($ch);
    }
}

// Usage example
$gateway = new ApiGateway('https://api.example.com');
$gateway->handleRequest();
