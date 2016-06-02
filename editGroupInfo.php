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
//echo "update tgroup set gname=".$newname." where userid=".$id." and gname=".$oldname.";";
//echo "update friend set groupname=".$newname."where userid=".$id." and groupname=".$oldname.";";
$groupresult=mysql_query("update tgroup set gname=".$newname." where userid=".$id." and gname=".$oldname.";");
$friendresult=mysql_query("update friend set groupname=".$newname."where userid=".$id." and groupname=".$oldname.";");

?>