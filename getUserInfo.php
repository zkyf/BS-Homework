<?php
class UserInfo
{
	public $id;
	public $name;
	public $desp;
	public $ip;
}
session_start();
$userinfo = new userinfo();
$userinfo->id=$_SESSION['id'];
$userinfo->name= $_SESSION['name'];
$userinfo->desp=$_SESSION['desp'];
$userinfo->ip=$_SESSION['ip'];

$json_user_info = json_encode($userinfo);
echo $json_user_info;
?>
