<?php

define('INCLUDE_CHECK',1);
require "../DBconnect.php";

if(!$_POST['img']) die("There is no such product!");

$img=mysql_real_escape_string(end(explode('/',$_POST['img'])));
$row=mysql_fetch_assoc(mysql_query("SELECT * FROM Shop WHERE imgage='".$img."'"));
$quantity=$row['quantity'];
if($quantity==0) die("This product if out of stock!");


$str=
'<option value="1">1</option>';
for ($i=2; $i <= $quantity; $i++){
	$str .='<option value="';
	$str .= $i;
	$str .= '">';
	$str .= $i;
	$str .= '</option>';
}

$data=array(
	'status' => 1,
	'id' => $row['id'],
	'price' => (float)$row['price'],
	'txt' => '<table width="100%" id="table_'.$row['id'].'">
  <tr>
    <td width="60%">'.$row['name'].'</td>
    <td width="10%">$'.$row['price'].'</td>
    <td width="15%"><select name="'.$row['id'].'_cnt" id="'.$row['id'].'_cnt" onchange="change('.$row['id'].');">

		'.$str.'
	</slect>

	</td>
	<td width="15%"><a href="#" onclick="window.remove('.$row['id'].');return false;" class="remove">remove</a></td>
  </tr>
</table>');


echo json_encode($data);

?>
