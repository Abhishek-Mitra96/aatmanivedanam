<?php
require_once '../../include/config.php';

$query=$_REQUEST["query"];
$flag=0;

$a='{"status":"Success",';
$audio="";
$category_audio="";
$category_video="";
$category_image="";
$event="";
$image="";
$video="";

if(isset($_REQUEST["query"])){  
    $min_length = 3;
    if(strlen($query) >= $min_length){
    	$query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        //$query = mysql_real_escape_string($query);
        // makes sure nobody uses SQL injection


        //$raw_results = mysqli_query("SELECT * FROM audio WHERE (`name` LIKE '%".$query."%')")or die(mysql_error());
        $raw_results="select * from `audio` where `name` like '%".$query."%' or 'description' like '%".$query."%'";
        $result=mysqli_query($con,$raw_results);
      	$row_count=mysqli_num_rows($result);
        if($row_count > 0){ // if one or more rows are returned do following
             
            //while($results = mysqli_fetch_array($raw_results)){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
             
                //echo "<p><h3>".$results['name']."</h3></p>";
                // posts results gotten from database(title and text) you can also show id ($results['id'])
            //}
            //echo "OK";
            $flag=1;
            
            while($row = $result->fetch_assoc()) {
        		
        		$audio.= "{".$row["name"]."}".",";
        		//$audio[]='$row["name"]';
        		//echo $a;
        		//array_push($audio, $row["name"]);
    		}
    		
    		
        }
       
        $raw_results="select * from `category_audio` where `name` like '%".$query."%' or 'description' like '%".$query."%'";
        $result=mysqli_query($con,$raw_results);
      	$row_count=mysqli_num_rows($result);
        if($row_count > 0){ // if one or more rows are returned do following
             
           
            $flag=1;
            while($row = $result->fetch_assoc()) {
        		//$a='{"status":"Success","result":"';
        		$category_audio.= "{".$row["name"]."}".",";
        		//$a.='"}';
        		//echo $a;
    		}
    		
        }
       
        $raw_results="select * from `category_image` where `name` like '%".$query."%' or 'description' like '%".$query."%'";
        $result=mysqli_query($con,$raw_results);
      	$row_count=mysqli_num_rows($result);
        if($row_count > 0){ // if one or more rows are returned do following
             
           
            $flag=1;
            while($row = $result->fetch_assoc()) {
        		//$a='{"status":"Success","result":"';
        		$category_image.= "{".$row["name"]."}".",";
        		//$a.='"}';
        		//echo $a;
    		}
    		
        }
        
        $raw_results="select * from `category_video` where `name` like '%".$query."%' or 'description' like '%".$query."%'";
        $result=mysqli_query($con,$raw_results);
      	$row_count=mysqli_num_rows($result);
        if($row_count > 0){ // if one or more rows are returned do following
             
            
            $flag=1;
            while($row = $result->fetch_assoc()) {
        		//$a='{"status":"Success","result":"';
        		$category_video.= "{".$row["name"]."}".",";
        		//$a.= $row["name"].",";
        		//$a.='"}';
        		//echo $a;
    		}
    		
        }
        
        $raw_results="select * from `event` where `name` like '%".$query."%' or 'description' like '%".$query."%'";
        $result=mysqli_query($con,$raw_results);
      	$row_count=mysqli_num_rows($result);
        if($row_count > 0){ // if one or more rows are returned do following
             
            
            $flag=1;
            while($row = $result->fetch_assoc()) {
        		//$a='{"status":"Success","result":"';
        		$event.= "{".$row["name"]."}".",";
        		//$a.='"}';
        		//echo $a;
    		}
    		
        }
        $raw_results="select * from `image` where `name` like '%".$query."%' or 'description' like '%".$query."%'";
        $result=mysqli_query($con,$raw_results);
      	$row_count=mysqli_num_rows($result);
        if($row_count > 0){ // if one or more rows are returned do following
             
            
            $flag=1;
            while($row = $result->fetch_assoc()) {
        		//$a='{"status":"Success","result":"';
        		$image.= "{".$row["name"]."}".",";
        		//$a.='"}';
        		//echo $a;
    		}
    		
        }
        $raw_results="select * from `video` where `name` like '%".$query."%' or 'description' like '%".$query."%'";
        $result=mysqli_query($con,$raw_results);
      	$row_count=mysqli_num_rows($result);
        if($row_count > 0){ // if one or more rows are returned do following
             
            
            $flag=1;
            while($row = $result->fetch_assoc()) {
        		//$a='{"status":"Success","result":"';
        		$video.= "{".$row["name"]."}".",";
        		//$a.='"}';
        		//echo $a;
    		}
    		
        }
        if($flag==0){
        	$a='{"status":"Failed"}';
        	echo $a;
        }
        else{

        	$a.='"audio":'.'"['.$audio.']"';
        	$a.=',"category_audio":'.'"['.$category_audio.']"';
        	$a.=',"category_image":'.'"['.$category_image.']"';
        	$a.=',"category_video":'.'"['.$category_video.']"';
        	$a.=',"event":'.'"['.$event.']"';
        	$a.=',"image":'.'"['.$image.']"';
        	$a.=',"video":'.'"['.$video.']"';


        	$a.='}'."\r\n";
        	echo $a;
        }


             
    }
}


?>