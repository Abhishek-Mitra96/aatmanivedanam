<?php

require_once '../../include/config.php';
logincheck();

echo wishlistUser($_REQUEST["user_id"]);

?>