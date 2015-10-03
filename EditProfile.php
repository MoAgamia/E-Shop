<?php
session_start();
include_once 'DBconnect.php';
include "NavigationBar.php";

if(!isset($_SESSION['user']))
{
	header("Location: Login.php");
}
$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$row=mysql_fetch_array($res);


if(isset($_POST['btn-login']))
{
  $username = mysql_real_escape_string($_POST['username']);
	$userlname = mysql_real_escape_string($_POST['userlname']);
	$email = mysql_real_escape_string($_POST['email']);
	$upass = mysql_real_escape_string($_POST['pass']);
  $unewpass = md5(mysql_real_escape_string($_POST['newpass']));
  $uconfnewpass = md5(mysql_real_escape_string($_POST['confnewpass']));

	if($row['password']==md5($upass))
	{
    if($unewpass==$uconfnewpass){

      if(mysql_query("UPDATE users SET username='$username', email='$email', userlastname='$userlname',password='$unewpass' WHERE user_id=".$_SESSION['user']))
      {

        ?>
            <script>alert('successfully updated ');</script>
            <?php
						header("Location: Homepage.php");
      }
      else
      {
        ?>
            <script>alert('error while updating your profile...');</script>
            <?php
      }

    }
    else
    {
      ?>
          <script>alert('New and Confirm passwords do not match');</script>
          <?php
    }
	}
	else
	{
		?>
        <script>alert('wrong password');</script>
        <?php
	}

}

include( 'ImageFunction.php');
// settings
$max_file_size = 1024*200; // 200kb
$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
// thumbnail sizes
$sizes = array(50 => 50, 250 => 250);

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_FILES['image'])) {
	if( $_FILES['image']['size'] < $max_file_size ){
		// get file extension
		$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
		if (in_array($ext, $valid_exts)) {
			/* resize image */
			foreach ($sizes as $w => $h) {
				$files[] = resize($w, $h);
			}

		} else {
			$msg = 'Unsupported file';
		}
	} else{
		$msg = 'Please upload image smaller than 200KB';
	}
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Profile Edit</title>
<link rel="stylesheet" href="stylecss.css" type="text/css" />
<meta charset="utf-8">
</head>
<body>
<center>
<table align="center" width="80%" border="0">
<td width="20%">
	<?php
	// show image thumbnails
	if(isset($files)){
		foreach ($files as $image) {
			if(stripos($image, "250") !== false){
			echo "<img class='img' src='{$image}' /><br /><br />";
		}
		else {
			mysql_query("UPDATE users SET imgage='$image' WHERE user_id=".$_SESSION['user']);
		}
		}
	}
	?>

			<div >
			<!-- file uploading form -->
			<form action="" method="post" enctype="multipart/form-data">
				<label>
					<span>Choose image</span><br><br>
					<input type="file" name="image" accept="image/*" /></input><br>
				</label>
				<br>
				<input type="submit" value="Upload" /></input>
			</form>
		</div>

			<?php if(isset($msg)): ?>
			<p class='alert'><?php echo $msg ?></p>
		<?php endif ?>
</td>
<td>

<div id="login-form">
<form method="post"><table align="center" width="50%" border="0">
<table align="center" width="80%" border="0">

<tr>
<td><input type="text" name="username" placeholder="Your New Name" required /></td>
</tr>
<tr>
<td><input type="text" name="userlname" placeholder="Your New Last Name" required /></td>
</tr>
<tr>
<td><input type="text" name="email" placeholder="Your New Email" required /></td>
</tr>
<tr>
<td><input type="password" name="pass" placeholder="Your Password" required /></td>
</tr>
<tr>
<td><input type="password" name="newpass" placeholder="Your New Password" required /></td>
</tr>
<tr>
<td><input type="password" name="confnewpass" placeholder="Confirm New Password" required /></td>
</tr>
<tr>
<td><button type="submit" name="btn-login">Edit</button></td>
</tr>
<tr>
<td><a href="Homepage.php">Back</a></td>
</tr>
</table>
</form>
</div>
</td>
</table>
</center>
</body>
</html>
