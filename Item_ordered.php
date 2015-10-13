<?php

session_start();
require "DBconnect.php";
include "NavigationBar.php";

if(!isset($_SESSION['user']))
{
	header("Location: Login.php");
	die("You are not logged in!");
}


$res=mysqli_query($connection,"SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
$hist=$userRow['history'];

if(!$_POST)
{
	if($_SERVER['HTTP_REFERER'])
	header('Location : '.$_SERVER['HTTP_REFERER']);

	exit;
}


?>

<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bought</title>

<link rel="stylesheet" type="text/css" href="stylecss.css" />

<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>

<script type="text/javascript" src="simpletip/jquery.simpletip-1.3.1.pack.js.txt"></script>


<script type="text/javascript" src="script.js"></script> -->

</head>

<body>

<div id="main-container">

    <div class="container">

    	<span class="top-label">
            <span class="label-txt">You Bought</span>
        </span>

        <div class="content-area">

    		<div class="content">


        <?php

				$cnt = array();
				$products = array();
				$total = 0;

				foreach($_POST as $key=>$value)
				{
					$key=(int)str_replace('_cnt','',$key);

					$products[]=$key;
					$cnt[$key]=$value;
				}

				$result = mysqli_query($connection,"SELECT * FROM Shop WHERE id IN(".join($products,',').")");
				$result2 = mysqli_query($connection,"SELECT * FROM Shop WHERE id IN(".join($products,',').")");

				if(!mysqli_num_rows($result))
				{
					echo '<h1>There was an error with your order!</h1>';
				}
				else
				{
					echo '<h1>You Bought:</h1>';

					while($row=mysqli_fetch_assoc($result))
					{
						echo '<h2>'.$cnt[$row['id']].' x '.$row['name'].'</h2>';

						// Calculate quantity
						$newquan=$row['quantity'] - $cnt[$row['id']];
						// Add quantity to database
            mysqli_query($connection,"UPDATE Shop SET quantity='$newquan' WHERE id=".$row['id']);
						// Caclulate user history
						$hist.=(string)$cnt[$row['id']] .' x '. (string)$row['name'] . ',';

						$total+=$cnt[$row['id']]*$row['price'];
					}

					echo '<h1>Total: $'.$total.'</h1>';

					// Caclulate user history
					$hist.="$" . (string)$total . ',';

					mysqli_query($connection,"UPDATE users SET history='$hist' WHERE user_id=".$_SESSION['user']);
				}


				?>

       	        <div class="clear"></div>


            </div>

        </div>

        <div class="bottom-container-border">
        </div>

    </div>

</div>

</body>
</html>
