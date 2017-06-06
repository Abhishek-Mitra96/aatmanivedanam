<?php

require_once '../../include/config.php';
admincheck();

    //$query="SELECT * FROM `messages` where ";
    $query="SELECT m.*,u.fname,u.lname FROM messages m left join user u on m.user_id=u.id  where ";

    if(isset($_REQUEST["search"]))
    {
        $search=clean($_REQUEST["search"]);
        
        $keywords=explode(" ", $search);
        $length=sizeof($keywords);

        if($length!=0)
        {
            for($i=0;$i<$length;$i++)
            {
                $query.="(m.message like '%".$keywords[$i]."%' ";
                $query.="or u.fname like '%".$keywords[$i]."%' ";
                $query.="or u.lname like '%".$keywords[$i]."%') and ";
            }
        }
    }
    
    if(isset($_REQUEST['status']) && $_REQUEST['status'] != '' && $_REQUEST['status'] != 3)
    {
        $query.="m.status = ".$_REQUEST['status'];  
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

    $query.="1 order by m.status, m.date desc limit {$limit} offset ".(($page-1)*$limit);

    if(isset($_REQUEST["message_id"]))
    {
        $query="SELECT m.*,u.* FROM messages m left join user u on m.user_id=u.id  where m.message_id='".$_REQUEST["message_id"]."'";
    }
    
    $result=mysqli_query($con,$query);
    
    $product=array();
    if(!$result)
    {
        $output='{"status":"false","remark":"Error while retreiving Messages!"}';
        error_log($query);
        error_log(mysqli_error($con));
    }
    else
    {
        if(mysqli_num_rows($result)>0)
        {
            while ($row=mysqli_fetch_assoc($result))
            {  
                $row["date"]=date("d-M-y",strtotime($row["date"]));
                $messages[]=$row; 
            }
            $output='{"status":"success","messages":';
            $output.=json_encode($messages);
            $output.="}";
        }
        else
        {
            $output='{"status":"false","remark":"No messages found!"}';
        }
    }
    echo $output;
    
    mysqli_close($con);
?>