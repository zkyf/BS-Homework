<?php
session_start();
$id=$_SESSION['id'];
$fid=$_POST['fid'];
$connect = mysql_connect("localhost","root","liujiaxin");
mysql_select_db("bshw");
if(!$connect)
{
	echo "database failure";
	exit;
}
echo "delete from friend where userid=".$id." and friendid=".$fid.";";
mysql_query("delete from friend where userid=".$id." and friendid=".$fid.";");
?>