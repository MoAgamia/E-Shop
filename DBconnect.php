<?php

/* Database config */

$db_host		= 'localhost';
$db_user		= 'root';
$db_pass		= 'mo141592';
$db_database	= 'Eshop';

/* End config */



$connection = new mysqli($db_host,$db_user,$db_pass,$db_database) or die('Unable to establish a DB connection');


?>
