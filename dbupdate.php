  
<?php
$db = new SQLite3('/data/darrhax.db') or die('DB Open failed');

$app_id = $_GET["db_id"];
$app_name = $_GET["db_name"];
$app_ip = $_GET["db_path"];

$db->exec("UPDATE dbs SET db_name='$db_name',db_path='$db_path' WHERE db_id='$db_id'");

?>
Updated!
