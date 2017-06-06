

<?php
require_once '../../include/config.php';
    $id=$_REQUEST['id'];
    $query="UPDATE user_review SET visibility = visibility^1 WHERE id = {$id};";

    $result=mysqli_query($con,$query);