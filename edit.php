<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
<script>
jQuery(document).ready(function(){

    jQuery('.ajaxform').submit( function() {

        $.ajax({
            url     : $(this).attr('action'),
            type    : $(this).attr('method'),
            data    : $(this).serialize(),
            success : function( response ) {
                        alert( response );
                        location.reload();
                      }
        });

        return false;
    });

});
</script>
<?php
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
?>
<link rel="icon" type="image/png" href="favicon.png" />
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
<A HREF="index.php">Back</A>
<table style="width:95%">
<?php

$db = new SQLite3('/data/quicknav.db') or die('DB Open failed');

$result = $db->query('SELECT server_id, server_name, server_mac, wol, section_size, server_ip FROM servers');
while ($row = $result->fetchArray())
 {
   ?><tr><form action="supdate.php" method="get" class="ajaxform"><input type="hidden" name="server_id" value="<?php echo $row['server_id'];?>">
      <td>Name : <input type="text" name="server_name" value="<?php echo "{$row['server_name']}";?>"></td>
      <td>Section Size : <select name="section_size">
	    <option value="12" <?php if ($row['section_size']==12) {?>selected="selected"<?php };?>>Full row</option>
	    <option value="6" <?php if ($row['section_size']==6) {?>selected="selected"<?php };?>>Half row</option>
	    <option value="4" <?php if ($row['section_size']==4) {?>selected="selected"<?php };?>>Small</option>
	  </td>
	  <td>WOL : <select name="wol">
	    <option value="1" <?php if ($row['wol']==1) {?>selected="selected"<?php };?>>Yes</option>
	    <option value="0" <?php if ($row['wol']==0) {?>selected="selected"<?php };?>>No</option>
	  </td>
	  <td>Mac : <input type="text" name="server_mac" size="20" value="<?php echo $row['server_mac'];?>"></td>
	  <td><input type="submit" value="Update" title="Modify Server"></form></td><td><form action="sdelete.php" method="get" title="Delete Server WARNING! Deletes all corresponding Apps"><input type="hidden" name="server_id" value="<?php echo $row['server_id'];?>"><input type="submit" value="Delete"></form></td>
	 </tr><?php
   $result2 = $db->query('SELECT app_id, app_name, app_ip, app_port, app_url, server_id FROM apps WHERE server_id = ' . $row['server_id'] . '');
     while ($row2 = $result2->fetchArray())
	  {
	    ?><tr><form action="aupdate.php" method="get"><input type="hidden" name="app_id" value="<?php echo $row2['app_id'];?>">
		   <td>App Name : <input type="text" name="app_name" value="<?php echo "{$row2['app_name']}";?>"></td>
		   <td>App IP : <input type="text" name="app_ip" value="<?php echo "{$row2['app_ip']}";?>"></td>
		   <td>App Port : <input type="text" name="app_port" value="<?php echo "{$row2['app_port']}";?>"></td>
		   <td>App URL : <input type="text" name="app_url" value="<?php echo "{$row2['app_url']}";?>"></td>
		   <td><input type="submit" value="Update" title="Modify App"></form></td><td><form action="adelete.php" method="get" title="Delete App"><input type="hidden" name="app_id" value="<?php echo $row2['app_id'];?>"><input type="submit" value="Delete"></form></td>
		  </tr><?php
	  }?>
	<tr><form action="ainsert.php" method="get"><input type="hidden" name="server_id" value="<?php echo $row['server_id'];?>">
		   <td>App Name : <input type="text" name="app_name" title="Application Name"></td>
		   <td>App IP : <input type="text" name="app_ip" title="IP Address to test App"></td>
		   <td>App Port : <input type="text" name="app_port" title="Port to test App"></td>
		   <td>App URL : <input type="text" name="app_url" title="URL for App, Optional"></td>
		   <td><input type="submit" value="Insert" title="Add new App"></form></td>
		  </tr><?php
 }  
?>
<tr><form action="sinsert.php" method="get">
	  <td>Add new server</td></tr>
      <tr><td>Name : <input type="text" name="server_name" title="Server Name"></td>
      <td>Section Size : <select name="section_size" title="Full row 4+ Apps, Half row 2-3 Apps, Small 1 App">
	    <option value="12">Full row</option>
	    <option value="6">Half row</option>
	    <option value="4">Small</option>
	  </td>
	  <td>WOL : <select name="wol" title="Enable Wake-on-LAN Button">
	    <option value="1">Yes</option>
	    <option value="0">No</option>
	  </td>
	  <td>Mac : <input type="text" name="server_mac" size="20" title="MAC Address in format 12:34:45:ab:cd:56, Required for WoL"></td>
	  <td><input type="submit" value="Insert" title="Add new Server"></form></td>
	 </tr>

</table>
<A HREF="index.php">Back</A><HR>
<?php
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 4);
echo 'Page generated in ' . $total_time . ' seconds.'; 

?>
</body></html>
