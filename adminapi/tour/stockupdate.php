<?php
require_once '../../include/config.php';

$count = count($_REQUEST['product_id']);
for ($i=0 ; $i < $count ; $i++ ) 
{
	if($_REQUEST['product_id'][$i]!="") 
	{
	$data[$i] = array(  'product_id' => $_REQUEST['product_id'][$i],
					'size' => $_REQUEST['size'][$i],
					'color' => $_REQUEST['color'][$i],
					'quantity' => $_REQUEST['quantity'][$i],
					'view' => 1,
					 );
	}

}

foreach ($data as $value) {
$obj=(object)$value;
$data=stockUpdate($obj);
}
echo $data;

 mysqli_close($con);
 ?>