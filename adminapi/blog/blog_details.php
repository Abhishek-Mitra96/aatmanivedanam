<?php
require_once '../../include/config.php';
// require_once '../../include/function.php';
// require_once '../../include/pagination.php';

  $obj=(object)$_REQUEST;
  $output=blogDetails($obj);
   echo $output;
 
 ?>
 
 
 