<html>
<body>
<?php
$db = new SQLite3('/data/quicknav.db') or die('DB Open failed');

$server_id = $_GET["server_id"];
$server_name = $_GET["server_name"];
$wol = $_GET["wol"];
$server_mac = $_GET["server_mac"];

$db->exec("UPDATE servers SET server_name='$server_name',wol='$wol',server_mac='$server_mac' WHERE server_id='$server_id'");

?>
Updated!
<A HREF="edit.php">Back</A>
<BR>
</body>
</html>
