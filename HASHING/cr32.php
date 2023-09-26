<?php
// Input string
$inputString = "Hello, World!";

// Calculate the CRC32 checksum
$crc32Checksum = crc32($inputString);

// Display the CRC32 checksum as a hexadecimal number
echo "Input String: $inputString\n";
echo "CRC32 Checksum (Hex): " . dechex($crc32Checksum) . "\n";

?>
