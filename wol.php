<?php
$mac=htmlspecialchars($_GET["mac"]);
$output = shell_exec("wakeonlan " . $mac);
//echo "Sent!";
?>
