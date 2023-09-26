<?php
function djb2Hash($str) {
    $hash = 5381;
    $len = strlen($str);
    for ($i = 0; $i < $len; $i++) {
        $hash = (($hash << 5) + $hash) + ord($str[$i]);
    }
    return $hash;
}

// Example usage:
$inputString = "sibn thomas is the king";
$djb2 = djb2Hash($inputString);
echo "DJB2 Hash: $djb2\n";
?>
