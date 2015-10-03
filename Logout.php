<?php
session_start();

if(!isset($_SESSION['user']))
{
	header("Location: Login.php");
}
else if(isset($_SESSION['user'])!="")
{
	header("Location: Homepage.php");
}

if(isset($_GET['logout']))
{
	session_destroy();
	unset($_SESSION['user']);
	header("Location: Homepage.php");
}
?>
