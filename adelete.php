<html>
<body>
<?php
$db = new SQLite3('/data/quicknav.db') or die('DB Open failed');

$app_id = $_GET["app_id"];

$db->exec("DELETE FROM apps WHERE app_id='$app_id'");

?>
Deleted!
<A HREF="edit.php">Back</A>
<BR>
</body>
</html>
