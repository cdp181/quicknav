<?php
$db = new SQLite3('/data/darrhax.db') or die('DB Open failed');

$db_id = $_GET["db_id"];

$db->exec("DELETE FROM dbs WHERE db_id='$db_id'");

?>
Deleted!
