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
if ($testarray["restatus"] == 'UP') {
  $im = imagecreatefrompng("images/up.png");
  header('Content-Type: image/png');
  imagepng($im);
  imagedestroy($im);
} else {
  $im = imagecreatefrompng("images/down.png");
  header('Content-Type: image/png');
  imagepng($im);
  imagedestroy($im);
}
?>
