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
<table style="border:1px solid black;margin-left:auto;margin-right:auto;" class="collaptable">

<?php

$db = new SQLite3('/data/darrhax.db') or die('DB Open failed');

$result = $db->query('SELECT db_id, db_name, db_path FROM dbs');

$tableid = 1;
$tableidapp = 20;

while ($row = $result->fetchArray())
 {
   ?><tr class="server" data-id="<?php echo $tableid;?>" data-parent=""><form action="dbupdate.php" method="get" class="ajaxform"><input type="hidden" name="server_id" value="<?php echo $row['server_id'];?>">
      <td>Name : <input type="text" name="db_name" value="<?php echo "{$row['db_name']}";?>"></td>
	  <td>Path : <input type="text" name="db_path" size="50" value="<?php echo $row['db_path'];?>" ></td>
	  <td><input type="submit" value="Update" title="Modify Server"></form></td><form action="dbdelete.php" method="get" class="ajaxform"><td><input type="hidden" name="db_id" value="<?php echo $row['db_id'];?>"><input type="submit" value="Delete" title="Delete Server WARNING! Deletes all corresponding Apps"></form></td>
	 </tr><?php
        $tableid++;
   }  
?>
<tr><form action="dbinsert.php" method="get" class="ajaxform">
	  <td colspan="6">Add new server</td></tr>
      <tr class="server"><td>Name : <input type="text" name="db_name" title="DB Name"></td>
	  <td>Path : <input type="text" name="db_path" size="20" title="DB Path in docker"></td>
	  <td colspan="2"><input type="submit" value="Insert" title="Add new DB"></form></td>
	 </tr>

</table><BR><table style="border:1px solid black;margin-left:auto;margin-right:auto;" class="collaptable">
<?php

$db2 = new SQLite3('/data/darrhax.db') or die('DB Open failed');
$result2 = $db2->query('SELECT db_id, db_name, db_path FROM dbs');
while ($row2 = $result2->fetchArray())
	{?><h1><?php
	echo $row2['db_name'];?></h1><table style="width:50%" class="collaptable">
	<?php
	$db3 = new SQLite3($row2['db_path']) or die('DB Open failed');
	$result3 = $db3->query('SELECT * FROM ScheduledTasks');
	while ($row3 = $result3->fetchArray())
		{?>
	<tr><td><?php echo "{$row3['Id']}";?></td>
	<td><?php echo "{$row3['TypeName']}";?></td>
	<form action="darrupdate.php" method="get" class="ajaxform">
	<input type="hidden" name="Id" value="<?php echo $row3['Id'];?>">
	<input type="hidden" name="db_path" value="<?php echo $row2['db_path'];?>">
	<td>Interval : <input type="text" name="Interval" value="<?php echo "{$row3['Interval']}";?>"></td>
	<td>LastExecution : <input type="text" name="LastExecution" value="<?php echo "{$row3['LastExecution']}";?>"></td>
	<td><input type="submit" value="Update" title="Update Schedule"></form></td>
	</tr><?php }?>
	</table><?php
	}?>

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
