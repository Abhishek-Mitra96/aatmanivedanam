<?php
require_once '../../include/config.php';
admincheck();


$query="select u.* from user u where ";

if (isset($_REQUEST['key']) && !empty($_REQUEST['key']))
 {
  $key = $_REQUEST['key'];
  
  //start string cleaning
  
  $count=1;
  while($count!=0)
   $key=str_replace("  ", " ", $key,$count);
  
  $key=clean($key);

  //string is clean now

  $keywords=explode(" ", $key);
  
  $length=sizeof($keywords);

  if($length!=0)
  {   
        for($i=0;$i<$length;$i++)
            {
                    $query.="(u.fname like '%{$keywords[$i]}%' OR u.lname like '%{$keywords[$i]}%' OR u.email like '%{$keywords[$i]}%' OR u.mobile like '%{$keywords[$i]}%' OR u.organization_name like '%{$keywords[$i]}%') AND ";
            }
  }
}

if(isset($_REQUEST["status"]))
{
    if($_REQUEST["status"]=="verified")
    {
      $query.=" u.`status`!=0 and ";
    }
    elseif($_REQUEST["status"]=="unverified")
    {
      $query.=" u.`status`=0 and ";
    }
}

if(isset($_REQUEST["id"]))
{
  $query.=" u.`id`=".$_REQUEST["id"]." and ";
}

$query.="1 ORDER BY u.`fname` ";

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

$query.=" limit {$limit} offset ".(($page-1)*$limit);

$result = mysqli_query($con,$query);

// error_log(mysqli_error($con));

if(mysqli_num_rows($result) > 0)
{
  $output='{"status":"success","users":';
  $users = array();
  while ($row = mysqli_fetch_assoc($result)) 
  {
    $row["dob"]=date("d-M-Y",strtotime($row["dob"]));
    $users[] = $row;
  }

  $output.=json_encode($users)."}";
}
else
{
  $output='{"status":"failure","remark":"No users found"}';
}


echo $output;
mysqli_close($con);

?>



 