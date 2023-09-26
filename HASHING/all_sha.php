<?php
// Input string
$inputString = "Hello, World!";

// SHA-1 Hash
$sha1Hash = sha1($inputString);
echo "SHA-1 Hash: $sha1Hash\n";

// SHA-256 Hash
$sha256Hash = hash('sha256', $inputString);
echo "SHA-256 Hash: $sha256Hash\n";

// SHA-384 Hash
$sha384Hash = hash('sha384', $inputString);
echo "SHA-384 Hash: $sha384Hash\n";

// SHA-512 Hash
$sha512Hash = hash('sha512', $inputString);
echo "SHA-512 Hash: $sha512Hash\n";

// SHA-3 (SHA3-256) Hash (Requires PHP 7.1+)
$sha3Hash = hash('sha3-256', $inputString);
echo "SHA-3 Hash (SHA3-256): $sha3Hash\n";

?>
