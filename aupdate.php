<html>
<body>
<?php
$db = new SQLite3('/data/quicknav.db') or die('DB Open failed');

$app_id = $_GET["app_id"];
$app_name = $_GET["app_name"];
$app_ip = $_GET["app_ip"];
$app_port = $_GET["app_port"];
$app_url = $_GET["app_url"];

$db->exec("UPDATE apps SET app_name='$app_name',app_ip='$app_ip',app_port='$app_port',app_url='$app_url' WHERE app_id='$app_id'");

?>
Updated!
<A HREF="edit.php">Back</A>
<BR>
</body>
</html>
