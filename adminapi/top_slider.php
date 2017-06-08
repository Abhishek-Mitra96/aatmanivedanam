<?php
require_once '../../include/config.php';

$output="";
if(isset($_REQUEST["id"]) && $_REQUEST["id"]!=""){
	$values = explode(",", $_REQUEST["id"]);
	echo $values;
}