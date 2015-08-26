<html>
<head>
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
//$testarray = teststatus("192.168.0.200","99");
//echo $testarray["restatus"];
//echo $testarray["rescss"];
?>
<div class="container">
<div class='row-fluid'><div class='span12'><div class='wellbg'><div class='wellheader'><div class='dashboard-wellheader'>
<h3>unRAID1<h3></div><button type="button" class="btn btn-warning" onclick="loadXMLDoc('00:25:90:a9:68:cd')"><i class="icon-info-sign icon-white"></i></button><div id="dashboard-activity-button-info"></div></div>
<div class='stats'>
<ul>
<?php $testarray = teststatus("192.168.0.150","80")?>
<li><A HREF="http://192.168.0.150"><div class='<?php echo $testarray["rescss"]?>'><h1><?php echo $testarray["restatus"]?></h1></div><h5>unRAID</A></h5></li>
<?php $testarray = teststatus("192.168.0.150","1088")?>
<li><A HREF="http://192.168.0.150:1088/sabnzbd/"><div class='<?php echo $testarray["rescss"]?>'><h1><?php echo $testarray["restatus"]?></h1></div><h5>SABnzbd</A></h5></li>
<?php $testarray = teststatus("192.168.0.150","5000")?>
<li><A HREF="http://192.168.0.150:5000/movie/"><div class='<?php echo $testarray["rescss"]?>'><h1><?php echo $testarray["restatus"]?></h1></div><h5>CouchPotato</A></h5></li>
<?php $testarray = teststatus("192.168.0.150","8181")?>
<li><A HREF="http://192.168.0.150:8181/home"><div class='<?php echo $testarray["rescss"]?>'><h1><?php echo $testarray["restatus"]?></h1></div><h5>Headphones</A></h5></li>
<?php $testarray = teststatus("192.168.0.150","32400")?>
<li><A HREF="http://192.168.0.150:32400/web/index.html#"><div class='<?php echo $testarray["rescss"]?>'><h1><?php echo $testarray["restatus"]?></h1></div><h5>Plex</A></h5></li>
<?php $testarray = teststatus("192.168.0.150","8989")?>
<li><A HREF="http://192.168.0.150:8989"><div class='<?php echo $testarray["rescss"]?>'><h1><?php echo $testarray["restatus"]?></h1></div><h5>nzbdrone</A></h5></li>
<?php $testarray = teststatus("192.168.0.150","8080")?>
<li><A HREF="http://192.168.0.150:8080/index.php"><div class='<?php echo $testarray["rescss"]?>'><h1><?php echo $testarray["restatus"]?></h1></div><h5>This Page</A></h5></li>
<li><A HREF="http://192.168.0.150:8080/plexWatch/index.php"><div class='<?php echo $testarray["rescss"]?>'><h1><?php echo $testarray["restatus"]?></h1></div><h5>plexWatch</A></h5></li>
<?php $testarray = teststatus("192.168.0.175","80")?>
<li><A HREF="http://192.168.0.175"><div class='<?php echo $testarray["rescss"]?>'><h1><?php echo $testarray["restatus"]?></h1></div><h5>IPMI</A></h5></li>
</ul>
</div></div></div>

<div class='row-fluid'><div class='span6'><div class='wellbg'><div class='wellheader'><div class='dashboard-wellheader'>
<h3>unRAID2</h3></div></div>
<div class='stats'>
<ul>
<?php $testarray = teststatus("192.168.0.166","80")?>
<li><A HREF="http://192.168.0.166"><div class='<?php echo $testarray["rescss"]?>'><h1><?php echo $testarray["restatus"]?></h1></div><h5>unRAID</A></h5></li>
<?php $testarray = teststatus("192.168.0.163","80")?>
<li><A HREF="http://192.168.0.163"><div class='<?php echo $testarray["rescss"]?>'><h1><?php echo $testarray["restatus"]?></h1></div><h5>IPMI</A></h5></li>
</ul>
</div></div></div>

<div class='row-fluid'><div class='span12'><div class='wellbg'><div class='wellheader'><div class='dashboard-wellheader'>
<h3>unRAID Test</h3></div><button type="button" class="btn btn-warning" onclick="loadXMLDoc('3c:d9:2b:02:0d:21')"><i class="icon-info-sign icon-white"></i></button><div id="dashboard-activity-button-info"></div></div>
<div class='stats'>
<ul>
<?php $testarray = teststatus("192.168.0.200","80")?>
<li><A HREF="http://192.168.0.200"><div class='<?php echo $testarray["rescss"]?>'><h1><?php echo $testarray["restatus"]?></h1></div><h5>unRAID</A></h5></li>
<?php $testarray = teststatus("192.168.0.200","1088")?>
<li><A HREF="http://192.168.0.200:1088"><div class='<?php echo $testarray["rescss"]?>'><h1><?php echo $testarray["restatus"]?></h1></div><h5>SABnzbd</A></h5></li>
<?php $testarray = teststatus("192.168.0.200","9091")?>
<li><A HREF="http://192.168.0.200:9091/transmission/web/"><div class='<?php echo $testarray["rescss"]?>'><h1><?php echo $testarray["restatus"]?></h1></div><h5>Transmission</A></h5></li>
<?php $testarray = teststatus("192.168.0.200","32400")?>
<li><A HREF="http://192.168.0.200:32400/web/index.html"><div class='<?php echo $testarray["rescss"]?>'><h1><?php echo $testarray["restatus"]?></h1></div><h5>Plex</A></h5></li>
</ul>
</div></div></div>
<div class='row-fluid'>
<div class='span4'>
<div class='wellbg'>
<div class='wellheader'>
<div class='dashboard-wellheader'>
<h3>Raspberry Pi</h></div></div>
<div class='stats'>
<ul>
<?php $testarray = teststatus("192.168.0.103","80")?>
<li><A HREF="http://192.168.0.103/ws8610.txt"><div class='<?php echo $testarray["rescss"]?>'><h1><?php echo $testarray["restatus"]?></h1></div><h5>Weather Logs</A></h5></li>
</ul>
</div></div></div>
<div class='row-fluid'>
<div class='span4'>
<div class='wellbg'>
<div class='wellheader'>
<div class='dashboard-wellheader'>
<h3>HTPC</h></div><button type="button" class="btn btn-warning" onclick="loadXMLDoc('90:2b:34:ac:31:44')"><i class="icon-info-sign icon-white"></i></button><div id="dashboard-activity-button-info"></div></div>
<div class='stats'>
<ul>
<?php $testarray = teststatus("192.168.0.97","3005")?>
<li><div class='<?php echo $testarray["rescss"]?>'><h1><?php echo $testarray["restatus"]?></h1></div><h5>OpenELEC</h5></li>
</ul>
</div></div></div>
<div class='row-fluid'>
<div class='span4'>
<div class='wellbg'>
<div class='wellheader'>
<div class='dashboard-wellheader'>
<h3>Switch</h></div></div>
<div class='stats'>
<ul>
<?php $testarray = teststatus("192.168.0.2","80")?>
<li><A HREF="http://192.168.0.2"><div class='<?php echo $testarray["rescss"]?>'><h1><?php echo $testarray["restatus"]?></h1></div><h5>Management</A></h5></li>
</ul>
</div></div></div>
<div class='row-fluid'>
<div class='span4'>
<div class='wellbg'>
<div class='wellheader'>
<div class='dashboard-wellheader'>
<h3>Router</h></div></div>
<div class='stats'>
<ul>
<?php $testarray = teststatus("192.168.0.1","80")?>
<li><A HREF="http://192.168.0.1"><div class='<?php echo $testarray["rescss"]?>'><h1><?php echo $testarray["restatus"]?></h1></div><h5>Management</A></h5></li>
</ul>
</div></div></div>
<div class='row-fluid'>
<div class='span4'>
<div class='wellbg'>
<div class='wellheader'>
<div class='dashboard-wellheader'>
<h3>SIP Gateway</h></div></div>
<div class='stats'>
<ul>
<?php $testarray = teststatus("192.168.0.239","80")?>
<li><A HREF="http://192.168.0.239"><div class='<?php echo $testarray["rescss"]?>'><h1><?php echo $testarray["restatus"]?></h1></div><h5>Management</A></h5></li>
</ul>
</div></div></div>
<div class='row-fluid'>
<div class='span4'>
<div class='wellbg'>
<div class='wellheader'>
<div class='dashboard-wellheader'>
<h3>Internet</h></div></div>
<div class='stats'>
<ul>
<?php $testarray = teststatus("195.88.229.22","443")?>
<li><A HREF="http://www.google.co.uk"><div class='<?php echo $testarray["rescss"]?>'><h1><?php echo $testarray["restatus"]?></h1></div><h5>Google</A></h5></li>
</ul>
</div></div></div>


</div>
</body></html>
