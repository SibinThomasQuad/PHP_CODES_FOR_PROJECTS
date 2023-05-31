<?php
$currentDateTime = new DateTime();
$roundedTime = clone $currentDateTime;
$minute = (int) $roundedTime->format('i');
$remainder = $minute % 15;

if ($remainder != 0) {
    $roundedTime->modify("+".(15 - $remainder)." minutes");
}

$roundedTimeString = $roundedTime->format('H:i');
echo $roundedTimeString;
?>
