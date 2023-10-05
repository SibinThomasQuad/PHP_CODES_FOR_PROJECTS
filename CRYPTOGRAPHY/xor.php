<?php
function xor_encrypt_decrypt($data, $key) {
    $result = '';

    // Repeat the key to match the length of the data
    $key = str_repeat($key, strlen($data) / strlen($key) + 1);
    $key = substr($key, 0, strlen($data));

    // Perform the XOR operation on each character in the data with the corresponding character in the key
    for ($i = 0; $i < strlen($data); $i++) {
        $result .= chr(ord($data[$i]) ^ ord($key[$i]));
    }

    // Encode the encrypted text in base64 format
    $encrypted_base64 = base64_encode($result);
    
    return $encrypted_base64;
}

function xor_decrypt($encrypted_base64, $key) {
    // Decode the base64-encoded text
    $encrypted_text = base64_decode($encrypted_base64);

    $result = '';

    // Repeat the key to match the length of the encrypted text
    $key = str_repeat($key, strlen($encrypted_text) / strlen($key) + 1);
    $key = substr($key, 0, strlen($encrypted_text));

    // Perform the XOR operation on each character in the encrypted text with the corresponding character in the key
    for ($i = 0; $i < strlen($encrypted_text); $i++) {
        $result .= chr(ord($encrypted_text[$i]) ^ ord($key[$i]));
    }

    return $result;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plaintext = $_POST['plaintext'];
    $key = $_POST['key'];

    // Encrypt the plaintext
    $encrypted_base64 = xor_encrypt_decrypt($plaintext, $key);
    echo "Encrypted text (base64): $encrypted_base64\n";

    // Decrypt the ciphertext
    $decrypted_text = xor_decrypt($encrypted_base64, $key);
    echo "Decrypted text: $decrypted_text\n";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>XOR Encryption in PHP</title>
</head>
<body>
    <form method="post">
        <label for="plaintext">Enter the plaintext:</label>
        <input type="text" id="plaintext" name="plaintext" required><br>

        <label for="key">Enter the encryption key:</label>
        <input type="text" id="key" name="key" required><br>

        <input type="submit" value="Encrypt and Decrypt">
    </form>
</body>
</html>
