<html>
<body>
<?php
$db = new SQLite3('/data/quicknav.db') or die('DB Open failed');

$app_name = $_GET["app_name"];
$app_ip = $_GET["app_ip"];
$app_port = $_GET["app_port"];
$app_url = $_GET["app_url"];
$server_id = $_GET["server_id"];

$db->exec("INSERT INTO apps (app_name,app_ip,app_port,app_url,server_id) VALUES ('$app_name','$app_ip','$app_port','$app_url','$server_id')");

?>
Application <?php echo $_GET["app_name"];?> Added!
<A HREF="edit.php">Back</A>
<BR>
</body>
</html>
