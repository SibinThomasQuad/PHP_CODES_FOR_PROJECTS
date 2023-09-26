<?php
<?php

$inputString = "Hello, World!";

// MD5 Hash
$md5Hash = md5($inputString);
echo "MD5 Hash: $md5Hash\n";

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

// CRC32 Hash
$crc32Checksum = crc32($inputString);
echo "CRC32 Checksum: $crc32Checksum\n";

// Adler-32 Hash
$adler32Checksum = adler32($inputString);
echo "Adler-32 Checksum: $adler32Checksum\n";

// DJB2 Hash (Custom Hash Function)
function djb2Hash($str) {
    $hash = 5381;
    $len = strlen($str);
    for ($i = 0; $i < $len; $i++) {
        $hash = (($hash << 5) + $hash) + ord($str[$i]);
    }
    return $hash;
}
$djb2 = djb2Hash($inputString);
echo "DJB2 Hash: $djb2\n";
?>

?>
