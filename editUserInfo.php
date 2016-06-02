<?php
session_start();
$id=$_SESSION['id'];
$name=$_POST['name'];
$desp=$_POST['desp'];
$connect = mysql_connect("localhost","root","liujiaxin");
if(!$connect)
{
	echo "database failure";
	exit;
}
mysql_select_db("bshw");
mysql_query("update user set name=".$name.", desp=".$desp." where id=".$id);
?>