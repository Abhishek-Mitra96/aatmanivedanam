 <?php
    require_once '../../include/config.php';
admincheck();

    $id = $_REQUEST['id'];
    
    $query2="DELETE FROM `admin_user` WHERE `id` = {$id}";
     $result2=mysqli_query($con,$query2);

    // $output='{"status":"success","remark":"'.$img.'"}';
    $output='{"status":"success","remark":"User deleted successfully"}';
    echo $output;

    mysqli_close($con);
 ?>
