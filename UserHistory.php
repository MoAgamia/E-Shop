<?php

session_start();
require "DBconnect.php";
include "NavigationBar.php";

if(!isset($_SESSION['user']))
{
	header("Location: Login.php");
	die("You are not logged in!");
}

$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);

?>

<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Checkout</title>

<link rel="stylesheet" type="text/css" href="stylecss.css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>

<script type="text/javascript" src="simpletip/jquery.simpletip-1.3.1.pack.js.txt"></script>


<script type="text/javascript" src="script.js"></script>

</head>

<body>


<div id="main-container">

    <div class="container">

    	<span class="top-label">
            <span class="label-txt">History</span>
        </span>

        <div class="content-area">

    		<div class="content">

                <?php

					echo '<h1>Your History:</h1><br>';
          $string=$userRow['history'];

          //-- handles it all in one pass
          $output = preg_split('/(\.\s?|,\s?)/', $string, -1, PREG_SPLIT_NO_EMPTY);

          //-- just output
          array_walk($output, function(&$item, $idx) {
            if(strpos($item,'$') !== false){
              echo '<h3 align="right">' . $item . PHP_EOL . '</h3><br>';
              echo '<hr width="640">';
            }
            else {
              echo '<h3>' . $item . PHP_EOL . '</h3><br>';
            }
          });

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
