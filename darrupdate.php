<?php
$db = new SQLite3($_GET["db_path"]) or die('DB Open failed');

$Id = $_GET["Id"];
$Interval = $_GET["Interval"];
$LastExecution = $_GET["LastExecution"];

$db->exec("UPDATE ScheduledTasks SET Interval='$Interval',LastExecution='$LastExecution' WHERE Id='$Id'");

?>
Updated!
