<?php
session_start();
$_SESSION['id']=$_POST['id'];
$_SESSION['password']=$_POST['password'];
include("config.php");
?>