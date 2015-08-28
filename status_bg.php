<?php
// Create a blank image and add some text
$im = imagecreatetruecolor(120, 120);
$text_color = imagecolorallocate($im, 0, 255, 0);
imagestring($im, 5, 5, 5,  'UP', $text_color);

// Set the content type header - in this case image/jpeg
header('Content-Type: image/jpeg');

// Output the image
imagejpeg($im);

// Free up memory
imagedestroy($im);
?>
