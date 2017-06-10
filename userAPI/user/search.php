<?php
require_once '../../include/config.php';

$query=$_REQUEST["query"];
$flag=0;
$count1=0;
//$count2=0;
// $count3=0;
// $count4=0;
// $count5=0;
// $count6=0;
// $count7=0;

$output='{"status":"Success"';
$audio="";
$category_audio="";
$category_video="";
$category_image="";
$event="";
$image="";
$video="";

$audio_arr=array();
$category_audio_arr=array();
$category_image_arr=array();
$category_video_arr=array();
$event_arr=array();
$image_arr=array();
$video_arr=array();
$blog_arr=array();
$c=array();

if(isset($_REQUEST["query"]))
{  
    $min_length = 3;
    $query=trim($query);
    if(strlen($query) >= $min_length)
    {
    	//$query = htmlspecialchars($query); 
        $query = explode(",", $_REQUEST["query"]);
        $query= array_map('trim', $query);

        $raw_results1="select * from `audio` where"; 
        $raw_results2="select * from `category_audio` where"; 
        $raw_results3="select * from `category_image` where ";
        $raw_results4="select * from `category_video` where" ;
        $raw_results5="select * from `event` where";
        $raw_results6="select * from `image` where";
        $raw_results7="select * from `video` where";
        $raw_results8="select * from `blog` where";
       

        // if($count1>0){
        //     $output='},{"status":"Success"';
        // }
        // $count1++;
        $output='{"status":"Success"';
        // $query=trim($query[$i]);

        //$raw_results = mysqli_query("SELECT * FROM audio WHERE (`name` LIKE '%".$query."%')")or die(mysql_error());
        for($i=0;$i<count($query);$i++)
        {
        
            $raw_results1.="`name` like '%".$query[$i]."%' or 'description' like '%".$query[$i]."%' or";
        }
        $raw_results1=substr($raw_results1, 0,-3);
        //echo $raw_results1;
        $result=mysqli_query($con,$raw_results1);
      	$row_count=mysqli_num_rows($result);
        if($row_count > 0)
        { // if one or more rows are returned do following
            
            
            $flag=1;
            
            while($row = $result->fetch_assoc()) 
            {
        		
        		
                $audio_arr[] = $row;
                // $audio.=json_encode($c);

    		}
    		
    		
        }
    
        
        $output.=', "audio":'; 
        $output.= json_encode($audio_arr);

        for($i=0;$i<count($query);$i++)
        {
        
            $raw_results2.="`name` like '%".$query[$i]."%' or 'description' like '%".$query[$i]."%' or";
        }
        $raw_results2=substr($raw_results2, 0,-3);
        //echo $raw_results2;
        $result=mysqli_query($con,$raw_results2);
        $row_count=mysqli_num_rows($result);
        if($row_count > 0)
        { // if one or more rows are returned do following
             
           
            $flag=1;
            while($row = $result->fetch_assoc()) 
            {
        		
                $category_audio_arr[]=$row;
    		}
    		
        }
       
        $output .=', "category_audio":' ;
        $output.= json_encode($category_audio_arr);

         for($i=0;$i<count($query);$i++)
        {
        
            $raw_results3.="`name` like '%".$query[$i]."%' or 'description' like '%".$query[$i]."%' or";
        }
        $raw_results3=substr($raw_results3, 0,-3);
        //echo $raw_results3;
        $result=mysqli_query($con,$raw_results3);
        $row_count=mysqli_num_rows($result);
        if($row_count > 0)
        { // if one or more rows are returned do following
             
           
            $flag=1;
            while($row = $result->fetch_assoc()) 
            {
        		
                $category_image_arr[]=$row;


    		}
    		
    		
        }

        $output .=', "category_image":' ;
        $output.= json_encode($category_image_arr);
        
         for($i=0;$i<count($query);$i++)
        {
        
            $raw_results4.="`name` like '%".$query[$i]."%' or 'description' like '%".$query[$i]."%' or";
        }
        $raw_results4=substr($raw_results4, 0,-3);
        //echo $raw_results4;
        $result=mysqli_query($con,$raw_results4);
        $row_count=mysqli_num_rows($result);
        if($row_count > 0)
        { // if one or more rows are returned do following
             
            
            $flag=1;
            while($row = $result->fetch_assoc()) 
            {
        		
                $category_video_arr[]=$row;

    		}
    		
    		
        }

        $output .=', "category_video":' ;
        $output.= json_encode($category_video_arr);
        
        for($i=0;$i<count($query);$i++)
        {
        
            $raw_results5.="`name` like '%".$query[$i]."%' or 'description' like '%".$query[$i]."%' or";
        }
        $raw_results5=substr($raw_results5, 0,-3);
        //echo $raw_results5;
        $result=mysqli_query($con,$raw_results5);
        $row_count=mysqli_num_rows($result);
        if($row_count > 0)
        { // if one or more rows are returned do following
             
            
            $flag=1;
            while($row = $result->fetch_assoc()) 
            {
        		
                $event_arr[]=$row;

    		}
    		
        }
        $output .=', "event":' ;
        $output.= json_encode($event_arr);

        for($i=0;$i<count($query);$i++)
        {
        
            $raw_results6.="`name` like '%".$query[$i]."%' or 'description' like '%".$query[$i]."%' or";
        }
        $raw_results6=substr($raw_results6, 0,-3);
        //echo $raw_results6;
        $result=mysqli_query($con,$raw_results6);
        $row_count=mysqli_num_rows($result);
        if($row_count > 0)
        { // if one or more rows are returned do following
             
            
            $flag=1;
            while($row = $result->fetch_assoc()) 
            {
        		

                $image_arr[]=$row;


    		}
    		
        }

        $output .=', "image":'; 
        $output.= json_encode($image_arr);

        for($i=0;$i<count($query);$i++)
        {
        
            $raw_results7.="`name` like '%".$query[$i]."%' or 'description' like '%".$query[$i]."%' or";
        }
        $raw_results7=substr($raw_results7, 0,-3);
        //echo $raw_results7;
        $result=mysqli_query($con,$raw_results7);
        $row_count=mysqli_num_rows($result);
        if($row_count > 0)
        { // if one or more rows are returned do following
             
            
            $flag=1;
            while($row = $result->fetch_assoc()) 
            {
        		
                $video_arr[]=$row;


    		}
    		
        }
        $output .=', "video":';
        $output.= json_encode($video_arr);



        for($i=0;$i<count($query);$i++)
        {
        
            $raw_results8.="`blog_title` like '%".$query[$i]."%' or 'blog_description' like '%".$query[$i]."%' or";
        }
        $raw_results8=substr($raw_results8, 0,-3);
        //echo $raw_results7;
        $result=mysqli_query($con,$raw_results8);
        $row_count=mysqli_num_rows($result);
        if($row_count > 0)
        { // if one or more rows are returned do following
             
            
            $flag=1;
            while($row = $result->fetch_assoc()) 
            {
                
                $blog_arr[]=$row;


            }
            
        }
        $output .=', "blog":';
        $output.= json_encode($blog_arr);



             
    }
    else
    {
    	$a='{"status":"Enter atleast 3 keywords!"}';
        	echo $a;
        	$flag=2;
    }
    if($flag==0)
    {
        	$a='{"status":"No data"}';
        	echo $a;
    }
    elseif($flag==1)
    {

        	// $a.='}'."\r\n";
            $output.='}'."\r\n";
        	echo $output;
    }
}


?>