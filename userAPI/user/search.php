<?php
require_once '../../include/config.php';

$query=$_REQUEST["query"];
$flag=0;
$count1=0;
$count2=0;
$count3=0;
$count4=0;
$count5=0;
$count6=0;
$count7=0;

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

if(isset($_REQUEST["query"])){  
    $min_length = 3;
    if(strlen($query) >= $min_length){
    	$query = htmlspecialchars($query); 
        


        //$raw_results = mysqli_query("SELECT * FROM audio WHERE (`name` LIKE '%".$query."%')")or die(mysql_error());
        $raw_results="select * from `audio` where `name` like '%".$query."%' or 'description' like '%".$query."%'";
        $result=mysqli_query($con,$raw_results);
      	$row_count=mysqli_num_rows($result);
        if($row_count > 0){ // if one or more rows are returned do following
             
            
            $flag=1;
            
            while($row = $result->fetch_assoc()) 
            {
        		
        		
                $audio_arr[] = $row;
                // $audio.=json_encode($c);

    		}
    		
    		
        }
        
        $output.=', "audio":'; 
        $output.= json_encode($audio_arr);

        $raw_results="select * from `category_audio` where `name` like '%".$query."%' or 'description' like '%".$query."%'";
        $result=mysqli_query($con,$raw_results);
      	$row_count=mysqli_num_rows($result);
        if($row_count > 0){ // if one or more rows are returned do following
             
           
            $flag=1;
            while($row = $result->fetch_assoc()) {
        		
                $category_audio_arr[]=$row;
    		}
    		
        }
       
        $output .=', "category_audio":' ;
        $output.= json_encode($category_audio_arr);

        $raw_results="select * from `category_image` where `name` like '%".$query."%' or 'description' like '%".$query."%'";
        $result=mysqli_query($con,$raw_results);
      	$row_count=mysqli_num_rows($result);
        if($row_count > 0){ // if one or more rows are returned do following
             
           
            $flag=1;
            while($row = $result->fetch_assoc()) {
        		
                $category_image_arr[]=$row;


    		}
    		
    		
        }

        $output .=', "category_image":' ;
        $output.= json_encode($category_image_arr);
        
        $raw_results="select * from `category_video` where `name` like '%".$query."%' or 'description' like '%".$query."%'";
        $result=mysqli_query($con,$raw_results);
      	$row_count=mysqli_num_rows($result);
        if($row_count > 0){ // if one or more rows are returned do following
             
            
            $flag=1;
            while($row = $result->fetch_assoc()) {
        		
                $category_video_arr[]=$row;

    		}
    		
    		
        }

        $output .=', "category_video":' ;
        $output.= json_encode($category_video_arr);
        
        $raw_results="select * from `event` where `name` like '%".$query."%' or 'description' like '%".$query."%'";
        $result=mysqli_query($con,$raw_results);
      	$row_count=mysqli_num_rows($result);
        if($row_count > 0){ // if one or more rows are returned do following
             
            
            $flag=1;
            while($row = $result->fetch_assoc()) {
        		
                $event_arr[]=$row;

    		}
    		
        }
        $output .=', "event":' ;
        $output.= json_encode($event_arr);

        $raw_results="select * from `image` where `name` like '%".$query."%' or 'description' like '%".$query."%'";
        $result=mysqli_query($con,$raw_results);
      	$row_count=mysqli_num_rows($result);
        if($row_count > 0){ // if one or more rows are returned do following
             
            
            $flag=1;
            while($row = $result->fetch_assoc()) {
        		

                $image_arr[]=$row;


    		}
    		
        }

        $output .=', "image":'; 
        $output.= json_encode($image_arr);

        $raw_results="select * from `video` where `name` like '%".$query."%' or 'description' like '%".$query."%'";
        $result=mysqli_query($con,$raw_results);
      	$row_count=mysqli_num_rows($result);
        if($row_count > 0){ // if one or more rows are returned do following
             
            
            $flag=1;
            while($row = $result->fetch_assoc()) {
        		
                $video_arr[]=$row;


    		}
    		
        }
        $output .=', "video":';
        $output.= json_encode($video_arr);



        $raw_results="select * from `blog` where `blog_title` like '%".$query."%' or 'blog_description' like '%".$query."%'";
        $result=mysqli_query($con,$raw_results);
        $row_count=mysqli_num_rows($result);
        if($row_count > 0){ // if one or more rows are returned do following
             
            
            $flag=1;
            while($row = $result->fetch_assoc()) {
                
                $blog_arr[]=$row;


            }
            
        }
        $output .=', "blog":';
        $output.= json_encode($blog_arr);
             
    }
    else{
    	$a='{"status":"Enter atleast 3 keywords!"}';
        	echo $a;
        	$flag=2;
    }
    if($flag==0){
        	$a='{"status":"Failed"}';
        	echo $a;
        }
        elseif($flag==1){

        	// $a.='}'."\r\n";
            $output.='}'."\r\n";
        	echo $output;
        }
}


?>