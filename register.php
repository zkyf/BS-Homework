<?php
error_reporting(0);
session_start();
$_SESSION['name']=$_POST['name'];
$_SESSION['password']=$_POST['password'];
$connect = mysql_connect("localhost","root","liujiaxin");
mysql_select_db("bshw");
$result=mysql_query("insert into user(name, password, lastip) values('".$_SESSION['name']."','".$_SESSION['password']."','".$_SERVER["REMOTE_ADDR"]."');");
$id=mysql_insert_id();
if(!$connect)
{
	echo "database failure";
	exit;
}
$_SESSION['id']=$id;
$_SESSION['desp']=$row['desp'];
echo "succeed";
?>