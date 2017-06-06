<?php

include_once '../../include/config.php';

$obj=(object)$_REQUEST;
$data=adminList($obj);

echo $data;
    mysqli_close($con);
?>