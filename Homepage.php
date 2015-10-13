<?php

session_start();
require 'DBconnect.php';

if(isset($_POST['submit']))
{
	$email = mysqli_real_escape_string($connection,$_POST['email']);
	$upass = mysqli_real_escape_string($connection,$_POST['pass']);
	$res=mysqli_query($connection,"SELECT * FROM users WHERE email='$email'");
	$row=mysqli_fetch_array($res);

	if($row['password']==md5($upass))
	{
		$_SESSION['user'] = $row['user_id'];
		header("Location: Homepage.php");
	}
	else
	{
		?>
        <script>
				alert('wrong details');
				window.location.href = "Homepage.php";
				</script>
        <?php
	}

}

?>

<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>E-Shoping</title>
<link rel="stylesheet" type="text/css" href="style.css">

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="stylecss.css" />

<!--[if lt IE 7]>
<style type="text/css">
	.pngfix { behavior: url(pngfix/iepngfix.htc);}
    .tooltip{width:200px;};
</style>
<![endif]-->


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>

<script type="text/javascript" src="popup_tip/jquery.simpletip-1.3.1.pack.js"></script>


<script type="text/javascript" src="script.js"></script>
<script src="myscript.js"></script>
</head>

<body>

	<div id="header">
	  <div id="left">
	    <label><a href="Homepage.php">E-Shop</a> </label>
	    </div>
	    <div id="right">
	      <div id="content">
	          <?php
	          if(isset($_SESSION['user']))
	          {
	            $res=mysqli_query($connection,"SELECT * FROM users WHERE user_id=".$_SESSION['user']);
	            $userRow=mysqli_fetch_array($res);
							echo '<img src="'.$userRow['imgage'].'" align="left" style="margin-top:-15px; margin-right:10px;" >';
							echo '  Hi  ';
	            echo $userRow['username'];
	            echo '&nbsp;<a href="UserHistory.php">History</a>';
	            echo '&nbsp;<a href="EditProfile.php">Edit Profile</a>';
	            echo '&nbsp;<a href="Logout.php?logout">Sign Out</a>';
	          }else {
							echo '  Hi  ';
	            echo 'Guest';
	            echo '&nbsp;<a class="signInbt href="Login.php?logout">Login</a>';
	          }  ?>
	        </div>
	    </div>
	</div>

	<div id="login-form">
	<form class="form" method="post">

		  <p class="clearfix">
	        <label for="login">Email</label>
	        <input type="text2" name="email" placeholder="User Email">
	    </p>
	    <p class="clearfix">
	        <label for="password">Password</label>
	        <input type="password" name="pass" placeholder="Password">
	    </p>
	    <p class="clearfix">
	        <input type="checkbox" name="remember" id="remember">
	        <label for="remember">Remember me</label>
	    </p>
	    <p class="clearfix">
	        <input type="submit" name="submit" value="Login">
	    </p>
	    <p class="registerbt">
        <a href="Register.php">
	      <button type="button" name="button">Sign Up</button>
      </a>
	    </p>
			<p>
				<input type="image" class="hide" src="images/up.png" />
			</p>


	</form>
</div>

<div id="main-container">

	<div class="tutorialzine">
    <h1>Shopping cart</h1>
    </div>


    <div class="container">

    	<span class="top-label">
            <span class="label-txt">Products</span>
        </span>

        <div class="content-area">

    		<div class="content drag-desired">

                <?php

				$result = mysqli_query($connection,"SELECT * FROM Shop");
				while($row=mysqli_fetch_assoc($result))
				{
					echo '<div class="product"><img src="images/products/'.$row['imgage'].'" alt="'.htmlspecialchars($row['name']).'" width="128" height="128" class="pngfix" /></div>';
				}

				?>


       	        <div class="clear"></div>
            </div>

        </div>

        <div class="bottom-container-border">
        </div>

    </div>



    <div class="container">

    	<span class="top-label">
            <span class="label-txt">Shopping Cart</span>
        </span>

        <div class="content-area">

    		<div class="content drop-here">
            	<div id="cart-icon">
								<img src="images/Shoppingcart_128x128.png" alt="shopping cart" class="pngfix" width="128" height="128" />
					<!-- <img src="img/ajax_load_2.gif" alt="loading.." id="ajax-loader" width="16" height="16" /> -->
								<img alt="Out Of Stock!" id="ajax-loader" width="150" height="16" />
							  </div>
				<form name="checkoutForm" method="post" action="Item_ordered.php">

                <div id="item-list">
                </div>

				</form>
                <div class="clear"></div>

				<div id="total"></div>

       	        <div class="clear"></div>

                <a href="" onclick="document.forms.checkoutForm.submit(); return false;" class="button">Buy</a>


          </div>

        </div>

        <div class="bottom-container-border">
        </div>

    </div>


</body>
</html>
