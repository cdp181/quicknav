<?php
$db = new SQLite3('/data/darrhax.db') or die('DB Open failed');

$db_name = $_GET["db_name"];
$db_path = $_GET["db_path"];

$db->exec("INSERT INTO dbs (db_name,db_path) VALUES ('$db_name','$db_path')");

?>
Database <?php echo $_GET["db_name"];?> Added!
