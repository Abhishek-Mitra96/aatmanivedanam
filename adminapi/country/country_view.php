<?php

include_once '../../include/config.php';


$obj=(object)$_REQUEST;
$data=countryList($obj);

echo $data;
    mysqli_close($con);
?>