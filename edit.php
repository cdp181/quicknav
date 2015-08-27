<html>
<head>
<?php
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
?>
<link rel="icon" type="image/png" href="favicon.png" />
<script>
function loadXMLDoc(mac)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("dashboard-activity-button-info").innerHTML=xmlhttp.responseText;
    }
  }
var url = "wol.php?mac=";
var macurl = url.concat(mac);
xmlhttp.open("GET",macurl,true);
xmlhttp.send();
}
</script>
<title>QuickNav</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="font-awesome.min.css">
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 20px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
</head><body>
<table style="width:95%">
<?php
function teststatus($host,$port) {
exec("nmap -p " . $port . " " . $host . " --max_rtt_timeout=15ms | grep open", $output, $result);
//print_r($output);
if ($result == 0){
//echo "Ping successful!";
$restatus="UP";
$rescss="statsup";
return array ("restatus" => $restatus, "rescss" => $rescss);
} else {
//echo "Ping unsuccessful!";
$restatus="DOWN";
$rescss="statsdown";
return array ("restatus" => $restatus, "rescss" => $rescss);
}
}
//$testarray = teststatus("192.168.0.200","99");
//echo $testarray["restatus"];
//echo $testarray["rescss"];

/**
 * $db->exec("INSERT INTO servers (server_id,server_name,wol,server_mac,server_ip) VALUES ('1','unRAID','1','00:25:90:a9:68:cd','192.168.0.150')");
 * $db->exec("INSERT INTO apps (app_id,server_id,app_name,app_port,app_ip,app_url) VALUES ('1','1','unRAID','80','192.168.0.150','http://192.168.0.150')");
*/



$db = new SQLite3('/data/quicknav.db') or die('DB Open failed');

$result = $db->query('SELECT server_id, server_name, server_mac, wol, section_size, server_ip FROM servers');
while ($row = $result->fetchArray())
 {
   ?><tr><form action="supdate.php" method="post"><input type="hidden" name="server_id" value="<?php echo $row['server_id'];?>">
      <td>Name : <input type="text" name="server_name" value="<?php echo "{$row['server_name']}";?>"></td>
      <td>Section Size : <select name="section_size">
	    <option value="12" <?php if ($row['section_size']==12) {?>selected="selected"<?php };?>>Full row</option>
	    <option value="6" <?php if ($row['section_size']==6) {?>selected="selected"<?php };?>>Half row</option>
	    <option value="4" <?php if ($row['section_size']==4) {?>selected="selected"<?php };?>>Small</option>
	  </td>
	  <td>WOL : <input type="checkbox" name="wol" size="3" value="<?php echo $row['wol']; ?>" <?php if ($row['wol']==1) {?>checked<?php };?>></td>
	  <td>Mac : <input type="text" name="server_mac" size="20" value="<?php echo $row['server_mac'];?>"></td>
	  <td><input type="submit" value="Submit"></form></td>
	 </tr><?php
   $result2 = $db->query('SELECT app_id, app_name, app_ip, app_port, app_url, server_id FROM apps WHERE server_id = ' . $row['server_id'] . '');
     while ($row2 = $result2->fetchArray())
	  {
	    ?><tr><form action="aupdate.php" method="post"><tr><input type="hidden" name="app_id" value="<?php echo $row2['app_id'];?>">
		   <td>App Name : <input type="text" name="app_name" value="<?php echo "{$row2['app_name']}";?>"></td>
		   <td>App IP : <input type="text" name="app_ip" value="<?php echo "{$row2['app_ip']}";?>"></td>
		   <td>App Port : <input type="text" name="app_port" value="<?php echo "{$row2['app_port']}";?>"></td>
		   <td>App URL : <input type="text" name="app_url" value="<?php echo "{$row2['app_url']}";?>"></td>
		   <td><input type="submit" value="Submit"></form></td>
		  </tr><?php
	  }
 }   
?></table><?php
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 4);
echo 'Page generated in ' . $total_time . ' seconds.'; 

?>
</body></html>
