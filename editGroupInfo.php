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
$result=mysql_query("select * from tgroup where userid=".$id." and gname=".$newname.";");
if(mysql_num_rows($result)==0)
{
	if($newname!="''")
	{
		mysql_query("update friend set groupname=".$newname."where userid=".$id." and groupname=".$oldname.";");
		mysql_query("update tgroup set gname=".$newname." where userid=".$id." and gname=".$oldname.";");
	}
	else
	{
		mysql_query("update friend set groupname=null where userid=".$id." and groupname=".$oldname.";");
		mysql_query("delete from tgroup where userid=".$id." and gname=".$oldname.";");
	}
}
echo $newname;
?>