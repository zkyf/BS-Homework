<?php
session_start();
$id = $_SESSION['id'];
$connect = mysql_connect("localhost","root","liujiaxin");
if(!$connect)
{
	echo "database failure";
	exit;
}
mysql_select_db("bshw");
$gc = mysql_num_rows(mysql_query("select * from tgroup where userid=".$id.";"));
$newname = "__NewGroup".$gc;
echo $newname;
mysql_query("insert into tgroup values(".$id.", '".$newname."');");
?>