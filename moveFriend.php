<?php
session_start();
$id=$_SESSION['id'];
$fid=$_POST['fid'];
$newg=$_POST['newg'];
$connect = mysql_connect("localhost","root","liujiaxin");
if(!$connect)
{
	echo "database failure";
	exit;
}
mysql_select_db("bshw");
if($newg!="'DefaultGroup'")
{
	if(mysql_num_rows(mysql_query("select * from tgroup where userid=".$id." and gname=".$newg.";"))==0)
	{
		exit;
	}
	echo "update friend set groupname=".$newg." where userid=".$id." and friendid=".$fid.";";
	mysql_query("update friend set groupname=".$newg." where userid=".$id." and friendid=".$fid.";");
}
else
{
	echo "update friend set groupname=null where userid=".$id." and friendid=".$fid.";";
	mysql_query("update friend set groupname=null where userid=".$id." and friendid=".$fid.";");
}

?>