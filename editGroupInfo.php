<?php
session_start();
$id = $_SESSION['id'];
$oldname = $_POST['oldname'];
$newname = $_POST['newname'];

$connect = mysql_connect("localhost","root","liujiaxin");
if(!$connect)
{
	echo "database failure";
	exit;
}
mysql_select_db("bshw");

$groupresult=mysql_query("select * from tgroup where userid=".$id." gname='"+$oldname+"';");
$grouprows=mysql_fetch_assoc($groupresult);
if(mysql_num_rows($grouprows)==1)
{
	$groupresult=mysql_query("select * from tgroup where userid=".$id." gname='"+$newname+"';");
	$grouprows=mysql_fetch_assoc($groupresult);
	if(!$grouprows)
	{
		$groupresult=mysql_query("update tgroup set gname='"+$newname+"'' where userid=".$id." gname='"+$oldname+"';");
		$friendresult=mysql_query("update friend set groupname='".$newname."'where userid=".$id." and groupname='".$oldname."';");
	}
}
?>