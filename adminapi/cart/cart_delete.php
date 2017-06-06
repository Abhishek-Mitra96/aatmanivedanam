 <?php
 
    require_once '../../include/config.php';

    logincheck();
  
    if(isset($_REQUEST['cartID']) && isset($_REQUEST["user_id"]))
    {
          $id = $_REQUEST['cartID'];
          $user_id=$_REQUEST["user_id"];

          $query="DELETE FROM `cart` WHERE `id`={$id}";
          mysqli_query($con,$query);
          $count = cartCount($user_id);
          $total_amount=cartAmount($user_id);
          $output='{"status":"success","cartCount":"'.$count.'","remark":"Item removed successfully","total_amount":"'.$total_amount.'"}';    

    }
    
    else
    {
      $output = '{"status":"failure","remark":"Incorrect or Insufficient Parameters Sent"}';
    }
    
    echo $output;

    mysqli_close($con);

    ?>