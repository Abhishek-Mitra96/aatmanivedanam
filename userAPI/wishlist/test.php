<?php

require_once '../../include/config.php';
logincheck();

//$obj=(object)$_REQUEST;
//echo videoNoCategoryList();

echo wishlistUser($_REQUEST["user_id"]);
//echo videoList($obj);
?>