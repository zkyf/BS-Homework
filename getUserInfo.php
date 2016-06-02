<?php
$_SESSION['config_show_result']=0;
session_start();
?>
<table>
	<tr>
		<td>ID</td>
		<td id="info_id"><?php echo $_SESSION['id']; ?></td>
	</tr>
	<tr>
		<td>Name</td>
		<td id="info_name"><?php echo $_SESSION['name']; ?></td>
	</tr>
	<tr>
		<td>Memo</td>
		<td id="info_desp"><?php echo $_SESSION['desp']; ?></td>
	</tr>
	<tr>
		<td>IP</td>
		<td id="info_ip"><?php echo$_SESSION['ip']; ?></td>
	</tr>
</table>