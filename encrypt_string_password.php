<?php

function encryptText($text, $password)
{
    // Generate a random initialization vector
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

    // Encrypt the text using the password and initialization vector
    $encryptedText = openssl_encrypt($text, 'aes-256-cbc', $password, 0, $iv);

    // Combine the initialization vector and encrypted text
    $encryptedData = $iv . $encryptedText;

    // Encode the encrypted data using base64
    $encodedData = base64_encode($encryptedData);

    return $encodedData;
}

function decryptText($encryptedData, $password)
{
    // Decode the encrypted data from base64
    $decodedData = base64_decode($encryptedData);

    // Extract the initialization vector and encrypted text
    $ivLength = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($decodedData, 0, $ivLength);
    $encryptedText = substr($decodedData, $ivLength);

    // Decrypt the text using the password and initialization vector
    $decryptedText = openssl_decrypt($encryptedText, 'aes-256-cbc', $password, 0, $iv);

    return $decryptedText;
}

// Usage example

$text = "This is a secret message.";
$password = "MyStrongPassword";

// Encrypt the text
$encryptedText = encryptText($text, $password);
echo "Encrypted Text: " . $encryptedText . "\n";

// Decrypt the text
$decryptedText = decryptText($encryptedText, $password);
echo "Decrypted Text: " . $decryptedText . "\n";

?>
