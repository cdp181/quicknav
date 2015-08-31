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

<?php
function teststatus($host,$port) {
exec("nmap -p " . $port . " " . $host . " --max_rtt_timeout=50ms | grep open", $output, $result);
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

$db = new SQLite3('/data/quicknav.db') or die('DB Open failed');

$result = $db->query('SELECT server_id, server_name, server_mac, wol, section_size FROM servers ORDER BY section_size DESC');
while ($row = $result->fetchArray())
 {
   ?><div class="container"><div class='row-fluid'><div class='span<?php echo $row['section_size'];?>'><div class='wellbg'><div class='wellheader'><div class='dashboard-wellheader'><h3><?php echo "{$row['server_name']}";?><h3></div><?php if ($row['wol'] == 1) { ?><button type="button" class="btn btn-warning" onclick="loadXMLDoc('<?php echo $row['server_mac'];?>')"><i class="icon-info-sign icon-white"></i></button><?php };?><div id="dashboard-activity-button-info"></div></div><div class='stats'><ul>
   <?php
   $result2 = $db->query('SELECT app_id, app_name, app_ip, app_port, app_url FROM apps WHERE server_id = ' . $row['server_id'] . '');
     while ($row2 = $result2->fetchArray())
	  {
	    $testarray = teststatus($row2['app_ip'], $row2['app_port']);?><li><?php if (!empty($row2['app_url'])) {?><A HREF="<?php echo $row2['app_url'];?>"><?php };?><div class='<?php echo $testarray["rescss"]?>'><h1><?php echo $testarray["restatus"]?></h1></div><h5><?php echo $row2['app_name'];if (!empty($row2['app_url'])) {?></A><?php };?></h5></li>
	  <?php
	  }
	  ?></ul></div></div></div><?php
 }   

$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 4);
echo 'Page generated in ' . $total_time . ' seconds.'; 

?>
<BR><a HREF="edit.php">Edit Database</a>
</body></html>
