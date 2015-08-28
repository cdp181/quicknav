<?php
$db = new SQLite3('/data/quicknav.db') or die('DB Open failed');

$server_id = $_GET["server_id"];

$db->exec("DELETE FROM servers WHERE server_id='$server_id'");
$db->exec("DELETE FROM apps WHERE server_id='$server_id'");

?>
Deleted!
