<?php
session_start();
include_once 'DBconnect.php';
include "NavigationBar.php";

if(isset($_SESSION['user'])!="")
{
	header("Location: Homepage.php");
}


if(isset($_POST['btn-signup']))
{
	$uname = mysql_real_escape_string($_POST['uname']);
	$email = mysql_real_escape_string($_POST['email']);
	$upass = md5(mysql_real_escape_string($_POST['pass']));

	if(mysql_query("INSERT INTO users(username,email,password) VALUES('$uname','$email','$upass')"))
	{
		$res=mysql_query("SELECT * FROM users WHERE email='$email'");
		$row=mysql_fetch_array($res);
		$_SESSION['user'] = $row['user_id'];
		header("Location: Homepage.php");
		?>
        <script>alert('successfully registered ');</script>
        <?php
	}
	else
	{
		?>
        <script>alert('error while registering you...');</script>
        <?php
	}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>E-Shop</title>
<link rel="stylesheet" href="stylecss.css" type="text/css" />

</head>
<body>
<center>
<div id="login-form">
<form method="post">
<table align="center" width="30%" border="0">
<tr>
<td><input type="text" name="uname" placeholder="User Name" required /></td>
</tr>
<tr>
<td><input type="email" name="email" placeholder="Your Email" required /></td>
</tr>
<tr>
<td><input type="password" name="pass" placeholder="Your Password" required /></td>
</tr>
<tr>
<td><button type="submit" name="btn-signup">Sign Me Up</button></td>
</tr>
<tr>
<td><aa><a href="Login.php">Login In</a></aa></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
