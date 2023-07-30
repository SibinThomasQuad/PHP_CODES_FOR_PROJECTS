<?php
session_start();

// Generate a random CAPTCHA code (four digits)
$random_number = rand(1000, 9999);

// Store the CAPTCHA code in the session for verification later
$_SESSION['captcha_code'] = $random_number;

// Create the image
$width = 100;
$height = 40;
$image = imagecreatetruecolor($width, $height);

// Set the background color and text color
$bg_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);

// Fill the background
imagefilledrectangle($image, 0, 0, $width, $height, $bg_color);

// Add random lines to make the CAPTCHA more secure
for ($i = 0; $i < 5; $i++) {
    $line_color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
    imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $line_color);
}

// Add the random CAPTCHA code as text
imagestring($image, 5, 25, 12, $random_number, $text_color);

// Set the content type header and output the image
header('Content-type: image/png');
imagepng($image);

// Clean up
imagedestroy($image);
?>
