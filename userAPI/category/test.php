<?php

require_once '../../include/config.php';

$obj=(object)$_REQUEST;
//echo videoNoCategoryList();
echo videoCategoryList($obj);
//echo videoList($obj);
?>