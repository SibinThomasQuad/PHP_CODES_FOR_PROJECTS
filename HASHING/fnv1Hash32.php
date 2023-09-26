<?php
function fnv1Hash32($str) {
    $fnvPrime = 16777619;
    $hash = 2166136261; // FNV offset basis for 32-bit
    $len = strlen($str);

    for ($i = 0; $i < $len; $i++) {
        $hash ^= ord($str[$i]);
        $hash *= $fnvPrime;
    }

    return $hash;
}

// Example usage:
$inputString = "Hello, World!";
$fnv1 = fnv1Hash32($inputString);
echo "FNV-1 Hash (32-bit): $fnv1\n";

?>
