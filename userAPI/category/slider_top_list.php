<?php

require_once '../../include/config.php';
// logincheck();

$obj=(object)$_REQUEST;
$obj->app=1;
$obj->status=1;
echo slider_top_list($obj);
// echo $obj->search;

?>