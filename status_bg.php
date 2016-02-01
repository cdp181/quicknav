<?php
function teststatus($host,$port) {
exec("nmap -p " . $port . " " . $host . " --max_rtt_timeout=15ms | grep open", $output, $result);
//print_r($output);
if ($result == 0){
//echo "Ping successful!";
$restatus="UP";
$rescss="statsup";
return array ("restatus" => $restatus, "rescss" => $rescss);
} else {
//echo "Ping unsuccessful!";
$restatus="DOWN";
$rescss="statsdown";
return array ("restatus" => $restatus, "rescss" => $rescss);
}
}
$hosttest = $_GET["app_id"];
$porttest = $_GET["app_port"];
$testarray = teststatus($hosttest, $porttest);
if ($testarray["restatus"] == UP) {

// Create a blank image and add some text
$im = imagecreatetruecolor(120, 120);
$text_color = imagecolorallocate($im, 0, 0, 0);
$backgroundColor = imagecolorallocate($im, 0, 255, 0);
//imagefill($im, 0, 0, $backgroundColor);
imagestring($im, 5, 5, 5,  'UP', $text_color);
// Set the content type header - in this case image/jpeg
header('Content-Type: image/jpeg');
// Output the image
imagejpeg($im);
// Free up memory
imagedestroy($im);
} else {
// Create a blank image and add some text
$im = imagecreatetruecolor(120, 120);
$text_color = imagecolorallocate($im, 0, 0, 0);
$backgroundColor = imagecolorallocate($im, 255, 0, 0);
imagefill($im, 0, 0, $backgroundColor);
//imagestring($im, 5, 5, 5,  'UP', $text_color);
// Set the content type header - in this case image/jpeg
header('Content-Type: image/jpeg');
// Output the image
imagejpeg($im);
// Free up memory
imagedestroy($im);
}
?>
