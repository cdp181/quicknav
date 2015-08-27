<html>
<body>
<?php
$db = new SQLite3('/data/quicknav.db') or die('DB Open failed');

$server_name = $_GET["server_name"];
$section_size = $_GET["section_size"];
$wol = $_GET["wol"];
$server_mac = $_GET["server_mac"];

$db->exec("INSERT INTO servers (server_name,section_size,wol,server_mac) VALUES ('$server_name','$section_size','$wol','$server_mac')");

?>
Server <?php echo $_GET["server_name"];?> Added!
<A HREF="edit.php">Back</A>
</body>
</html>
