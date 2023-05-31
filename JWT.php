<?php

class JWT
{
    private $secretKey;

    public function __construct($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    public function createToken($payload)
    {
        $header = json_encode([
            'typ' => 'JWT',
            'alg' => 'HS256'
        ]);

        $base64UrlHeader = $this->base64UrlEncode($header);
        $base64UrlPayload = $this->base64UrlEncode($payload);

        $signature = hash_hmac('sha256', $base64UrlHeader . '.' . $base64UrlPayload, $this->secretKey, true);
        $base64UrlSignature = $this->base64UrlEncode($signature);

        $token = $base64UrlHeader . '.' . $base64UrlPayload . '.' . $base64UrlSignature;
        return $token;
    }

    public function verifyToken($token)
    {
        $parts = explode('.', $token);

        $header = $parts[0];
        $payload = $parts[1];
        $signature = $parts[2];

        $base64UrlHeader = $this->base64UrlDecode($header);
        $base64UrlPayload = $this->base64UrlDecode($payload);

        $newSignature = hash_hmac('sha256', $header . '.' . $payload, $this->secretKey, true);
        $base64UrlNewSignature = $this->base64UrlEncode($newSignature);

        if ($base64UrlSignature === $base64UrlNewSignature) {
            return json_decode($base64UrlPayload, true);
        }

        return false;
    }

    private function base64UrlEncode($data)
    {
        $base64 = base64_encode($data);
        $base64Url = str_replace(['+', '/', '='], ['-', '_', ''], $base64);
        return $base64Url;
    }

    private function base64UrlDecode($data)
    {
        $base64Url = str_replace(['-', '_'], ['+', '/'], $data);
        $base64 = base64_decode($base64Url);
        return $base64;
    }
}

// Example usage
$secretKey = 'your_secret_key';
$jwt = new JWT($secretKey);

// Create JWT token
$payload = [
    'user_id' => 123,
    'username' => 'john_doe'
];
$token = $jwt->createToken(json_encode($payload));
echo 'Token: ' . $token . "\n";

// Verify and retrieve data from JWT token
$decodedPayload = $jwt->verifyToken($token);
if ($decodedPayload) {
    echo 'Decoded Payload: ' . json_encode($decodedPayload) . "\n";
} else {
    echo 'Invalid token.' . "\n";
}

?>
