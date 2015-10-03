<?php

define('INCLUDE_CHECK',1);
require "../DBconnect.php";

if(!$_POST['img']) die("There is no such product!");

$img=mysql_real_escape_string(end(explode('/',$_POST['img'])));

$row=mysql_fetch_assoc(mysql_query("SELECT * FROM Shop WHERE imgage='".$img."'"));

if(!$row) die("There is no such product!");

if ($row['quantity']==0) {
  $quant='Out Of Stock';
} else {
  $quant=$row['quantity'];
}

echo '<strong>'.$row['name'].'</strong>

<p class="descr">'.$row['description'].'</p>

<strong>In Stock: '.$quant.'</strong> <br>

<strong>Price: $'.$row['price'].'</strong>
<small>Drag it to your shopping cart to purchase it</small>';
?>
