<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['config_show_result']))
	$_SESSION['config_show_result']=1;
$connect = mysql_connect("localhost","root","liujiaxin");
mysql_select_db("bshw");
$result=mysql_query("select * from user where id='".$_SESSION['id']."' and password='".$_SESSION['password']."';");
$row=mysql_fetch_assoc($result);
if(!$connect)
{
	if($_SESSION['config_show_result']!=0)
		echo "database failure";
	exit;
}
if(!$row)
{
	if($_SESSION['config_show_result']!=0)
    echo "failure";
   exit;
}
$_SESSION['name']=$row['name'];
$_SESSION['desp']=$row['desp'];
$ip = $_SERVER["REMOTE_ADDR"];
$result=mysql_query("update user set lastip='".$ip."' where id='".$_SESSION['id']."' and password='".$_SESSION['password']."';");
$result=mysql_query("update user set newuser=0 where id='".$_SESSION['id']."' and password='".$_SESSION['password']."';");
$result=mysql_query("select * from user where id='".$_SESSION['id']."' and password='".$_SESSION['password']."';");
$row=mysql_fetch_assoc($result);
$_SESSION['ip']=$row['lastip'];
if($_SESSION['config_show_result']!=0)
	echo "succeed";
?>