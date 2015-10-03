<?php

/* Database config */

$db_host		= 'localhost';
$db_user		= 'user';
$db_pass		= 'password';
$db_database	= 'Eshop';

/* End config */



$link = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');

mysql_select_db($db_database,$link);
mysql_query("SET names UTF8");

?>
