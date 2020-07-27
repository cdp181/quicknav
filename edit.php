<!DOCTYPE html>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
<script src="jquery.aCollapTable.js"></script>
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
</head><body>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="font-awesome.min.css">
<style>
table {
   border-collapse: collapse;
}
table, th, td {
   border: 1px solid black;
}
tr.server {background-color:#33CC33;margin:0;border:0;padding:0;}
tr.app {background-color:#ff9900;margin:0;border:0;padding:0;}
</style>
<A HREF="index.php">Back</A>
<table style="width:95%" class="collaptable">
<?php

$db = new SQLite3('/data/quicknav.db') or die('DB Open failed');

$result = $db->query('SELECT server_id, server_name, server_mac, wol, section_size, server_ip FROM servers');

$tableid = 1;
$tableidapp = 20;

while ($row = $result->fetchArray())
 {
   ?><tr class="server" data-id="<?php echo $tableid;?>" data-parent=""><form action="supdate.php" method="get" class="ajaxform"><input type="hidden" name="server_id" value="<?php echo $row['server_id'];?>">
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
	  <td>Mac : <input type="text" name="server_mac" size="20" value="<?php echo $row['server_mac'];?>" maxlength="17" size="17"></td>
	  <td><input type="submit" value="Update" title="Modify Server"></form></td><form action="sdelete.php" method="get" class="ajaxform"><td><input type="hidden" name="server_id" value="<?php echo $row['server_id'];?>"><input type="submit" value="Delete" title="Delete Server WARNING! Deletes all corresponding Apps"></form></td>
	 </tr><?php
   $result2 = $db->query('SELECT app_id, app_name, app_ip, app_port, app_url, server_id FROM apps WHERE server_id = ' . $row['server_id'] . '');
     while ($row2 = $result2->fetchArray())
	  {
	    ?><tr class="app" data-id="<?php echo $tableidapp++;?>" data-parent="<?php echo $tableid;?>"><form action="aupdate.php" method="get" class="ajaxform"><input type="hidden" name="app_id" value="<?php echo $row2['app_id'];?>">
		   <td>App Name : <input type="text" name="app_name" value="<?php echo "{$row2['app_name']}";?>"></td>
		   <td>App IP : <input type="text" name="app_ip" value="<?php echo "{$row2['app_ip']}";?>" maxlength="15" size="15"></td>
		   <td>App Port : <input type="text" name="app_port" value="<?php echo "{$row2['app_port']}";?>" maxlength="5" size="5"></td>
		   <td>App URL : <input type="text" name="app_url" value="<?php echo "{$row2['app_url']}";?>" maxlength="128" size="50"></td>
		   <td><input type="submit" value="Update" title="Modify App"></form></td><form action="adelete.php" method="get" class="ajaxform"><td><input type="hidden" name="app_id" value="<?php echo $row2['app_id'];?>"><input type="submit" value="Delete" title="Delete App"></form></td>
		  </tr><?php
	  }?>
	<tr class="app" data-id="<?php echo $tableidapp++;?>" data-parent="<?php echo $tableid;?>"><form action="ainsert.php" method="get" class="ajaxform"><input type="hidden" name="server_id" value="<?php echo $row['server_id'];?>">
		   <td>App Name : <input type="text" name="app_name" title="Application Name"></td>
		   <td>App IP : <input type="text" name="app_ip" title="IP Address to test App" maxlength="15" size="15"></td>
		   <td>App Port : <input type="text" name="app_port" title="Port to test App" maxlength="5" size="5"></td>
		   <td>App URL : <input type="text" name="app_url" title="URL for App, Optional" maxlength="128" size="50"></td>
		   <td colspan="2"><input type="submit" value="Insert" title="Add new App"></form></td>
		   </tr><?php
        $tableid++;
   }  
?>
<tr><form action="sinsert.php" method="get" class="ajaxform">
	  <td colspan="6">Add new server</td></tr>
      <tr class="server"><td>Name : <input type="text" name="server_name" title="Server Name"></td>
      <td>Section Size : <select name="section_size" title="Full row 4+ Apps, Half row 2-3 Apps, Small 1 App">
	    <option value="12">Full row</option>
	    <option value="6">Half row</option>
	    <option value="4">Small</option>
	  </td>
	  <td>WOL : <select name="wol" title="Enable Wake-on-LAN Button">
	    <option value="1">Yes</option>
	    <option value="0">No</option>
	  </td>
	  <td>Mac : <input type="text" name="server_mac" size="20" title="MAC Address in format 12:34:45:ab:cd:56, Required for WoL" maxlength="17" size="17"></td>
	  <td colspan="2"><input type="submit" value="Insert" title="Add new Server"></form></td>
	 </tr>

</table>
<script>
$(document).ready(function(){
  $('.collaptable').aCollapTable({ 
    startCollapsed: true,
    addColumn: true, 
    plusButton: '<span class="i">+</span>', 
    minusButton: '<span class="i">-</span>' 
  });
});
</script>
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
