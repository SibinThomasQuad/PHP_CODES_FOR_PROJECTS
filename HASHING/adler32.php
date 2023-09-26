<?php
function adler32($data) {
    $MOD_ADLER = 65521;
    $a = 1;
    $b = 0;
    $len = strlen($data);

    for ($i = 0; $i < $len; $i++) {
        $a = ($a + ord($data[$i])) % $MOD_ADLER;
        $b = ($b + $a) % $MOD_ADLER;
    }

    return ($b << 16) | $a;
}

// Input string
$inputString = "bibin thomas";

// Calculate the Adler-32 checksum
$adler32Checksum = adler32($inputString);

// Display the Adler-32 checksum as a hexadecimal number
echo "Input String: $inputString\n";
echo "Adler-32 Checksum (Hex): " . dechex($adler32Checksum) . "\n";

?>
