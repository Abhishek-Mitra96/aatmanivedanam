<?php
require_once '../../include/config.php';

$obj=(object)$_REQUEST;
$data=imageCategoryList($obj);

echo $data;

mysqli_close($con);
  
?>