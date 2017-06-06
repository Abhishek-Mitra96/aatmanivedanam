<?php
require_once '../../include/config.php';


$query="SELECT o.*,u.name,p.* FROM `order_management` o LEFT JOIN user u ON u.id= o.user_id left join payment_details p on p.orderNo=o.orderNo WHERE ";


//old search query, just in case...

// if (isset($_REQUEST['search']) && !empty($_REQUEST['search']))
//  {
//   $search = numOnly($_REQUEST['search']);
  
//   //start string cleaning
  
//   $count=1;
//   while($count!=0)
//    $search=str_replace(" ","", $search,$count);
  
//   $search=clean($search);

//   //string is clean now
  
//   $query.=" o.orderNo='{$search}' and ";

//   }


  if (isset($_REQUEST['search']) && !empty($_REQUEST['search']))
 {
  $search = clean($_REQUEST['search']);

  $keywords=explode(" ", $search);

  for($i=0;$i<sizeof($keywords);$i++)
  {
      $query.=" (o.orderNo='{$keywords[$i]}' or u.name like '%{$keywords[$i]}%') and ";  
  }

  }

  if (isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id']))
  {
    $query.=" o.user_id=".$_REQUEST["user_id"]." and ";
  }
  if (isset($_REQUEST['status']) && $_REQUEST["status"]!="-2")
  {
    $query.=" o.order_status=".$_REQUEST["status"]." and ";
  }


if(isset($_REQUEST["limit"]) && $_REQUEST["limit"]!=0)
    {
        $limit=$_REQUEST["limit"];
    }
    else
    {
        $limit=10;
    }

    if(isset($_REQUEST["page"]) && $_REQUEST["page"]!=0)
    {
        $page=$_REQUEST["page"];
    }
    else
    {
        $page=1;
    }


$query.=" !(p.payment_method=1 and p.payment_status=0) ORDER BY o.id DESC limit {$limit} offset ".(($page-1)*$limit);

  $result = mysqli_query($con,$query);
   
            
    if(mysqli_num_rows($result) > 0)
    {
      $output='{"status":"success","orders":';
         $order = array();
     while ($row = mysqli_fetch_assoc($result)) 
      {
        $row['order_date']= date("d-M-y, h:i A",strtotime($row['order_date']));
        $row["order_status"]=order_status($row["order_status"]);
        $row["payment_status"]=payment_status($row["payment_status"]);
        $row["payment_method"]=payment_method($row["payment_method"]);
        // $row['delivered_date']= date("d M, Y h:i A",strtotime($row['delivered_date']));
        $order[] = $row;
      }

     $output.=json_encode($order).'}';
    }
    else{
      $output='{"status":"failure","remark":"No orders found"}';
   }
  
  // error_log($query);
  echo $output;
mysqli_close($con);
?>