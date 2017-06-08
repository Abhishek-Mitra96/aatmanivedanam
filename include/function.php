<?php
/*
this file is created by Nazish Fraz on 22 feb 2017
*/


function clean($input)
{
  return preg_replace('/[^A-Za-z0-9 ]/', '', $input); // Removes special chars.
}
function rinse($input)
{
    return preg_replace('/[^A-Za-z0-9\-,@.\ ]/', '', $input); // Removes special chars.
}

function numOnly($input)
{
  return preg_replace('/[^0-9 ]/', '', $input); // Removes special chars.
}

function securityToken(){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 10; $i++) {
        $randstring.=$characters[rand(0, strlen($characters)-1)];
    }
    return $randstring;
}

function logincheck()
{
    $output="[";
    global $con;

    if(isset($_SESSION["user_id"]))
    {
        $output.='{"status":"success"}';
    }
    elseif(isset($_REQUEST["user_id"]) && isset($_REQUEST["security_token"]))
    {    
        $query="select `security_token` from `user` where `user_id`='".$_REQUEST["user_id"]."'";
        $result=mysqli_query($con,$query);
        $row=mysqli_fetch_array($result);
        if($row["security_token"]==$_REQUEST["security_token"]){
            $output.='{"status":"success"}';
        }
        else
            $output.='{"status":"error","remark":"Incorrect Security token. User id entered is '.$_REQUEST["user_id"].' and security token entere is '.$_REQUEST["security_token"].'"}';
    }
    else
    {
        $output.='{"status":"error","remark":"User id or security token is missing"}';
    }
    $output.="]";
    // echo $output;
    $obj=json_decode($output,true);

    if($obj[0]['status']=="error")
        die($output);

}

function admincheck()
{
    if(!isset($_SESSION["user_type"])=="admin")
    {
        die("You are not authorized for this request");
    }
}

function getMobile($user_id)   // get mobile number of the customer
{
    global $con;

    $query="select `mobile` from `user` where `id`=".$user_id;
    $result=mysqli_query($con,$query);
    $row=mysqli_fetch_array($result);
    return $row["mobile"];

}

function  upload_file($myfile,$dir,$max_file_size=102400)
{
    $error=0;
    $obj=new stdClass();
    $file_name=rinse(date("YmdHis").$_FILES[$myfile]['name']);
    $file_name=str_replace(" ", "", $file_name);
    $file_add=$_FILES[$myfile]['tmp_name'];
    
    $file_size = $_FILES[$myfile]['size'];
    if ($_FILES[$myfile]['error'] !== UPLOAD_ERR_OK) 
    {
       $error=1;
       $message="File not uploaded properly.";
    }
    elseif (($file_size > $max_file_size))
    {      
        $message = 'File too large. File must be within '.($max_file_size/1024).' KB.'; 
        $error=1;
     }

     $info = getimagesize($_FILES[$myfile]['tmp_name']);
    if ($info === FALSE) 
    {
       $error=1;
       $message="Unable to determine image type of uploaded file";
    }

    if (($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) 
    {
       $error=1;
       $message="Only JPEG or PNG image allowed";
    }
    
    if($error==0)
    {
        if(move_uploaded_file($file_add,$dir."/".$file_name))
        {
            $message="file uploaded succesfuly";
        }
        else
        {
            $message = $_FILES[$myfile]['error'];
            $error=1;
                // $message=$dir;
        }
    }
    $obj->error=$error;
    $obj->message=$message;
    $obj->file_name=$file_name;

    return $obj;
  
}

function  upload_file_modified($myfile,$dir,$max_file_size=102400,$i)
{
    
    $error=0;
    $obj=new stdClass();
    $file_name=rinse(time().$_FILES[$myfile]['name'][$i]);
    $file_name=str_replace(" ", "", $file_name);
    $file_add=$_FILES[$myfile]['tmp_name'][$i];
    
    $file_size = $_FILES[$myfile]['size'][$i];
    if ($_FILES[$myfile]['error'][$i] !== UPLOAD_ERR_OK) 
    {
       $error=1;
       $message="File not uploaded properly.";
    }
    elseif (($file_size > $max_file_size))
    {      
        $message = 'File too large. File must be within '.($max_file_size/1024).' KB.'; 
        $error=1;
     }

    $info = getimagesize($_FILES[$myfile]['tmp_name'][$i]);
    $mime   = $info['mime'];
  
    if ($info === FALSE) 
    {
       $error=1;
       $message="Unable to determine image type of uploaded file";
    }
    
    if (($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) 
    {
       $error=1;
       $message="Only JPEG or PNG image allowed";
    }
    
    if($error==0)
    {
        if(move_uploaded_file($file_add,$dir."/".$file_name))
        {
            $message="file uploaded succesfuly";
        }
        else
        {
            $message = $_FILES[$myfile]['error'];
            $error=1;
                // $message=$dir;
        }
    }
    $obj->error=$error;
    $obj->message=$message;
    $obj->file_name=$file_name;

    return $obj;
  
}


function deleteImage($path)
{
    global $hostname;
    $new_path=str_replace($hostname, "", $path);
    if(strlen($new_path)!=0)
    {
        return unlink("../../".$new_path);
        // return "inside";
    }
    return "0";
}
        
function redirect_to( $location = NULL ) {
            if ($location != NULL) {
              header("Location: {$location}");
              exit;
            }
          }

function send_notification($message)
{
    global $fcm_auth;

        $data=array(
        'title' => $message->title,
        'body' => $message->body,
        'id' => mt_rand(1,9999)
                );

$url = 'https://fcm.googleapis.com/fcm/send';            
                $fields = array
                (
                    'to'  => $message->token,
                    'data' => $data,
                );
                
        $headers = array($fcm_auth,'Content-Type: application/json');
                $ch = curl_init();
                curl_setopt( $ch, CURLOPT_URL , $url);
                curl_setopt( $ch,CURLOPT_POST, true);
                curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                $result = curl_exec($ch);
                
        if($result === FALSE){
        die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        //return json_encode($fields);
        return $result;
}

function send_all_notification($message)
{
    global $fcm_auth;

        $data=array(
        'title' => $message->title,
        'body' => $message->body,
        'id' => mt_rand(1,9999)
                );

        $registration_ids=$message->registration_ids;

$url = 'https://fcm.googleapis.com/fcm/send';            
                $fields = array
                (
                    // 'to'  => $message->token,
                    'registration_ids' => $registration_ids,
                    'data' => $data
                );
                
        $headers = array($fcm_auth,'Content-Type: application/json');
                $ch = curl_init();
                curl_setopt( $ch, CURLOPT_URL , $url);
                curl_setopt( $ch,CURLOPT_POST, true);
                curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                $result = curl_exec($ch);
                
        if($result === FALSE){
        die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        //return json_encode($fields);
        return $result;
}

//*******************************************for table check
function checkdata($table,$col,$id){
    if($table!="" && $col!="" && $id!=""){

    }else{
        redirect_to("../admin/video_category.php");
    }
}

//*******************************************for video********************
function videoCategoryList($obj)
{
	//if category_id set, return detail of that category
	//else return eitire category list
	//with no-category
	//obj list category_id, search, status, limit, page
	global $con;
	$category_id=0;
	$category_video=array();
    $min_range=0;
	$query="select * from `category_video` where ";

    //this is only for app verification
    if(isset($obj->app) && $obj->app!="" && $obj->app==1){
        $query.="`category_id`<>0 and ";
        $min_range=1;
    }
	//for search
    if(isset($obj->search) && $obj->search!=""){
        $search=clean($obj->search);
        $count=1;
        while($count!=0)
            $search=str_replace("  "," ", $search,$count);
        
        $keywords=explode(" ", $search);
        $length=sizeof($keywords);
        if($length!=0)
        {
            for($i=0;$i<$length;$i++)
            {
                $query.=" (`name` like '%".$keywords[$i]."%') and ";
            }
        }
    }

  	
    if(isset($obj->status) && $obj->status=="1")
        $query.=" `status`=1 ";
    else if(isset($obj->status) && $obj->status=="0")
        $query.=" `status`=0 ";
    else $query.=" (`status`=0 or `status`=1) ";

    //for limit
    if(isset($obj->limit) && $obj->limit!=0)
        $limit=$obj->limit;
    else
        $limit=10;

    //for page
    if(isset($obj->page) && $obj->page!=0)
        $page=$obj->page;
    else
        $page=1;

    $query.=" order by `category_id` desc limit {$limit} offset ".(($page-1)*$limit);

    if(isset($obj->category_id) && $obj->category_id!=""){
        $category_id=numOnly($obj->category_id);
        $query="select * from `category_video` where `category_id`='".$category_id."' ";
    }

    $result=mysqli_query($con,$query);
    if($result){
        //query success
        $output='{"status":"success", "video_category":';
        while ($row=mysqli_fetch_assoc($result)){
            $category_id=$row["category_id"];
            
            $ob=new stdClass();
			$ob->category_id=$category_id;
            //$ob->status=$obj->status;
            $data=videoCategoryIdList($ob);
            $arr=json_decode($data);
            if(sizeof($arr)>=$min_range){
            	$row["url"]=$arr[0]->url;
            	$category_video[]=$row;
            }
        }
        $output.=json_encode($category_video);
        $output.=', "video_list":'.videoCategoryIdList($obj);
        $output.='}';
        return $output;
    }else{
        //somthing problem with query
        return '{"status":"failure","remark":"somthing problem with the query", "query":"'.$query.'"}';
    }
}

function videoList($obj)
{
	//if video_id is set, return detail of that video
	//else return entire video list
	//obj list video_id, search, status, limit, page
	global $con;
	$video_list=array();
	$query="select v.*, c.name as 'category_name', c.status as 'category_status' from `video` v join `category_video` c where v.category_id=c.category_id and ";

	//for search
    if(isset($obj->search) && $obj->search!=""){
        $search=clean($obj->search);
        $count=1;
        while($count!=0)
            $search=str_replace("  "," ", $search,$count);
        
        $keywords=explode(" ", $search);
        $length=sizeof($keywords);
        if($length!=0)
        {
            for($i=0;$i<$length;$i++)
            {
                $query.=" (v.`name` like '%".$keywords[$i]."%') and ";
            }
        }
    }

  	
    if(isset($obj->status) && $obj->status=="1")
        $query.=" v.`status`=1 ";
    else if(isset($obj->status) && $obj->status=="0")
        $query.=" v.`status`=0 ";
    else $query.=" (v.`status`=0 or v.`status`=1) ";

    //for limit
    if(isset($obj->limit) && $obj->limit!=0)
        $limit=$obj->limit;
    else
        $limit=10;

    //for page
    if(isset($obj->page) && $obj->page!=0)
        $page=$obj->page;
    else
        $page=1;

    $query.=" order by v.`video_id` desc limit {$limit} offset ".(($page-1)*$limit);

    if(isset($obj->video_id) && $obj->video_id!=""){
        $video_id=numOnly($obj->video_id);
        $query="select v.*, c.name as 'category_name', c.status as 'category_status' from `video` v join `category_video` c where v.category_id=c.category_id and v.video_id=".$video_id;
    }

    $result=mysqli_query($con,$query);
    if($result){
        //query success
        $output='{"status":"success", "video_list":';
        while ($row=mysqli_fetch_assoc($result)){
            $video_list[]=$row;
        }
        $output.=json_encode($video_list);

        //for similar video code is here
        if(isset($obj->video_id) && $obj->video_id!=""){
            $output.=', "video_similar":';
            $video_similar=array();

            $obj=new stdClass();
            $obj->status=1;
            $obj->category_id=$video_list[0]["category_id"];
            $arr=json_decode(videoCategoryList($obj));
            if($arr->status=="success" && sizeof($arr->video_list)>0){
                $count=0;
                while($count<=10 && sizeof($arr->video_list)>$count){
                    $video_similar[]=$arr->video_list[$count];
                    $count+=1;
                }
            }
            $output.=json_encode($video_similar);
        }
        $output.='}';
        return $output;
    }else{
        //somthing problem with query
        return '{"status":"failure","remark":"somthing problem with the query", "query":"'.$query.'"}';
    }
}

function videoCategoryIdList($obj)
{
	//it return all the video list which is under uncategory list
	global $con;
	$video_list=array();

	$query="select * from `video` where ";

	//for search
    if(isset($obj->search) && $obj->search!=""){
        $search=clean($obj->search);
        $count=1;
        while($count!=0)
            $search=str_replace("  "," ", $search,$count);
        
        $keywords=explode(" ", $search);
        $length=sizeof($keywords);
        if($length!=0)
        {
            for($i=0;$i<$length;$i++)
            {
                $query.=" (`name` like '%".$keywords[$i]."%') and ";
            }
        }
    }

    if(isset($obj->category_id) && $obj->category_id!=""){
    	$category_id=numOnly($obj->category_id);
    	$query.=" `category_id`='".$category_id."' and ";
    }else{
    	$category_id=0;
    	$query.=" `category_id`='".$category_id."' and ";
    }

  	
    if(isset($obj->status) && $obj->status=="1")
        $query.=" `status`=1 ";
    else if(isset($obj->status) && $obj->status=="0")
        $query.=" `status`=0 ";
    else $query.=" (`status`=0 or `status`=1) ";

    //for limit
    if(isset($obj->limit) && $obj->limit!=0)
        $limit=$obj->limit;
    else
        $limit=10;

    //for page
    if(isset($obj->page) && $obj->page!=0)
        $page=$obj->page;
    else
        $page=1;

    $query.=" order by `video_id` desc limit {$limit} offset ".(($page-1)*$limit);
    $result=mysqli_query($con,$query);
    while($row=mysqli_fetch_assoc($result)){
		//$row["category_name"]="Uncategory";
		$video_list[]=$row;
	}
	return json_encode($video_list);
}

//*******************************************for image********************
function imageCategoryList($obj)
{
	//if category_id set, return detail of that category
	//else return eitire category list
	//with no-category
	//obj list category_id, search, status, limit, page
	global $con, $image_location, $hostname;
	$category_id=0;
	$category_image=array();
    $min_range=0;
	$query="select * from `category_image` where ";

    //this is only for app verification
    if(isset($obj->app) && $obj->app!="" && $obj->app==1){
        $query.="`category_id`<>0 and ";
        $min_range=1;
    }

	//for search
    if(isset($obj->search) && $obj->search!=""){
        $search=clean($obj->search);
        $count=1;
        while($count!=0)
            $search=str_replace("  "," ", $search,$count);
        
        $keywords=explode(" ", $search);
        $length=sizeof($keywords);
        if($length!=0)
        {
            for($i=0;$i<$length;$i++)
            {
                $query.=" (`name` like '%".$keywords[$i]."%') and ";
            }
        }
    }

  	
    if(isset($obj->status) && $obj->status=="1")
        $query.=" `status`=1 ";
    else if(isset($obj->status) && $obj->status=="0")
        $query.=" `status`=0 ";
    else $query.=" (`status`=0 or `status`=1) ";

    //for limit
    if(isset($obj->limit) && $obj->limit!=0)
        $limit=$obj->limit;
    else
        $limit=10;

    //for page
    if(isset($obj->page) && $obj->page!=0)
        $page=$obj->page;
    else
        $page=1;

    $query.=" order by `category_id` desc limit {$limit} offset ".(($page-1)*$limit);

    if(isset($obj->category_id) && $obj->category_id!=""){
        $category_id=numOnly($obj->category_id);
        $query="select * from `category_image` where `category_id`=".$category_id;
    }

    $result=mysqli_query($con,$query);
    if($result){
        //query success
        $output='{"status":"success", "dir_url":"'.$hostname.''.$image_location.'", "image_category":';
        while ($row=mysqli_fetch_assoc($result)){
            $category_id=$row["category_id"];
            
            $ob=new stdClass();
			$ob->category_id=$category_id;
            //$ob->status=$obj->status;
            $data=imageCategoryIdList($ob);
            $arr=json_decode($data);
            if(sizeof($arr)>=$min_range){
            	$row["url"]=$arr[0]->url;
            	$category_image[]=$row;
            }
        }
        $output.=json_encode($category_image);
        $output.=', "image_list":'.imageCategoryIdList($obj);
        $output.='}';
        return $output;
    }else{
        //somthing problem with query
        return '{"status":"failure","remark":"somthing problem with the query", "query":"'.$query.'"}';
    }
}

function blogList($obj)
{

    global $con;

    $blog = array();

    $query="SELECT * FROM blog ";

    $query.=" WHERE ";

    if (isset($obj->search) && !empty($obj->search))
    {

        $search = clean($obj->search);

        //start string cleaning

        $count=1;

        while($count!=0)
        {

            $search=str_replace("  "," ", $search,$count);

            //string is clean now

            $keywords=explode(" ", $search);

            $length=sizeof($keywords);

            if($length!=0)
            {
                for($i=0;$i<$length;$i++)
                {
                    $query.="(blog_title like '%".$keywords[$i]."%') AND ";
                }
            // $query=substr($query, 0,strlen($query)-4);  // remove the last AND word

            // $query.=" ORDER BY t.tour_id DESC limit {$start}, {$last}";    
            }
        }

        // if(isset($obj->category))

        // {

        //   $category=$obj->category;

        //   $query.=" b.blog_cat_id='".$category."' and ";

        // }

        // if(!isset($obj->viewall))

        // {

        //   $query.=" `status`=1 and ";

        // }

        // if (isset($obj->status) && $obj->status!="-2")
        // {    
        //   $query.=" status=".$obj->status." and ";
        // }

    }
        
    if(isset($obj->limit) && $obj->limit!=0)
    {    
        $limit=$obj->limit;
    }    
    else
    {
        $limit=10;
    }



    if(isset($obj->page) && $obj->page!=0)
    {
        $page=$obj->page;
    }
    else
    {
        $page=1;
    }



    $query.="1 group by blog_id order by blog_date desc limit {$limit} offset ".(($page-1)*$limit);

    if (isset($obj->id) && !empty($obj->id))
    {
        $query="Select * from blog where blog_id =".$obj->id;
    }

    $result = mysqli_query($con,$query);





    if(mysqli_num_rows($result) > 0)
    {

        $output='{"status":"success","blog":';

        while ($row = mysqli_fetch_assoc($result)) 
        {
            $blog[] = $row;
        }

        $output.=json_encode($blog);

        $output.='}';

    }

    else
    {

        $output='{"status":"failure","remark":"No blog found"}';
    }

                // $output.=$query;

    return $output;
    // return $query;

}



function imageList($obj)
{
	//if image_id is set, return detail of that image
	//else return entire image list
	//obj list image_id, search, status, limit, page
	global $con,$hostname,$image_location;
	$image_list=array();
	$query="select v.*, c.name as 'category_name',c.status as 'category_status' from `image` v join `category_image` c where v.category_id=c.category_id and ";

	//for search
    if(isset($obj->search) && $obj->search!=""){
        $search=clean($obj->search);
        $count=1;
        while($count!=0)
            $search=str_replace("  "," ", $search,$count);
        
        $keywords=explode(" ", $search);
        $length=sizeof($keywords);
        if($length!=0)
        {
            for($i=0;$i<$length;$i++)
            {
                $query.=" (v.`name` like '%".$keywords[$i]."%') and ";
            }
        }
    }
  	
    if(isset($obj->status) && $obj->status=="1")
        $query.=" v.`status`=1 ";
    else if(isset($obj->status) && $obj->status=="0")
        $query.=" v.`status`=0 ";
    else $query.=" (v.`status`=0 or v.`status`=1) ";

    //for limit
    if(isset($obj->limit) && $obj->limit!=0)
        $limit=$obj->limit;
    else
        $limit=10;

    //for page
    if(isset($obj->page) && $obj->page!=0)
        $page=$obj->page;
    else
        $page=1;

    $query.=" order by v.`image_id` desc limit {$limit} offset ".(($page-1)*$limit);

    if(isset($obj->image_id) && $obj->image_id!=""){
        $image_id=numOnly($obj->image_id);
        $query="select v.*, c.name as 'category_name',c.status as 'category_status' from `image` v join `category_image` c where v.category_id=c.category_id and v.image_id=".$image_id;
    }

    $result=mysqli_query($con,$query);
    if($result){
        //query success
        $output='{"status":"success", "dir_url":"'.$hostname.''.$image_location.'", "image_list":';
        while ($row=mysqli_fetch_assoc($result)){
            $image_list[]=$row;
        }
        $output.=json_encode($image_list);

        //for similar image, code is here
        if(isset($obj->image_id) && $obj->image_id!=""){
            $output.=', "image_similar":';
            $image_similar=array();

            $obj=new stdClass();
            $obj->status=1;
            $obj->category_id=$image_list[0]["category_id"];
            $arr=json_decode(imageCategoryList($obj));
            if($arr->status=="success" && sizeof($arr->image_list)>0){
                $count=0;
                while($count<=10 && sizeof($arr->image_list)>$count){
                    $image_similar[]=$arr->image_list[$count];
                    $count+=1;
                }
            }
            $output.=json_encode($image_similar);
        }
        $output.='}';
        return $output;
    }else{
        //somthing problem with query
        return '{"status":"failure","remark":"somthing problem with the query", "query":"'.$query.'"}';
    }
}

function imageCategoryIdList($obj)
{
	//it return all the image list which is under given category list else uncategory list
	global $con;
	$image_list=array();

	$query="select * from `image` where ";

	//for search
    if(isset($obj->search) && $obj->search!=""){
        $search=clean($obj->search);
        $count=1;
        while($count!=0)
            $search=str_replace("  "," ", $search,$count);
        
        $keywords=explode(" ", $search);
        $length=sizeof($keywords);
        if($length!=0)
        {
            for($i=0;$i<$length;$i++)
            {
                $query.=" (`name` like '%".$keywords[$i]."%') and ";
            }
        }
    }

    if(isset($obj->category_id) && $obj->category_id!=""){
    	$category_id=numOnly($obj->category_id);
    	$query.=" `category_id`='".$category_id."' and ";
    }else{
    	$category_id=0;
    	$query.=" `category_id`='".$category_id."' and ";
    }

  	
    if(isset($obj->status) && $obj->status=="1")
        $query.=" `status`=1 ";
    else if(isset($obj->status) && $obj->status=="0")
        $query.=" `status`=0 ";
    else $query.=" (`status`=0 or `status`=1) ";

    //for limit
    if(isset($obj->limit) && $obj->limit!=0)
        $limit=$obj->limit;
    else
        $limit=10;

    //for page
    if(isset($obj->page) && $obj->page!=0)
        $page=$obj->page;
    else
        $page=1;

    $query.=" order by `image_id` desc limit {$limit} offset ".(($page-1)*$limit);
    $result=mysqli_query($con,$query);
    while($row=mysqli_fetch_assoc($result)){
		//$row["category_name"]="Uncategory";
		$image_list[]=$row;
	}
	return json_encode($image_list);
}

//*******************************************for audio********************
function audioCategoryList($obj)
{
	//if category_id set, return detail of that category
	//else return eitire category list
	//with no-category
	//obj list category_id, search, status, limit, page
	global $con, $audio_location, $hostname;
	$category_id=0;
	$category_audio=array();
    $min_range=0;
	$query="select * from `category_audio` where ";

    //this is only for app verification
    if(isset($obj->app) && $obj->app!="" && $obj->app==1){
        $query.="`category_id`<>0 and ";
        $min_range=1;
    }

	//for search
    if(isset($obj->search) && $obj->search!=""){
        $search=clean($obj->search);
        $count=1;
        while($count!=0)
            $search=str_replace("  "," ", $search,$count);
        
        $keywords=explode(" ", $search);
        $length=sizeof($keywords);
        if($length!=0)
        {
            for($i=0;$i<$length;$i++)
            {
                $query.=" (`name` like '%".$keywords[$i]."%') and ";
            }
        }
    }

  	
    if(isset($obj->status) && $obj->status=="1")
        $query.=" `status`=1 ";
    else if(isset($obj->status) && $obj->status=="0")
        $query.=" `status`=0 ";
    else $query.=" (`status`=0 or `status`=1) ";

    //for limit
    if(isset($obj->limit) && $obj->limit!=0)
        $limit=$obj->limit;
    else
        $limit=10;

    //for page
    if(isset($obj->page) && $obj->page!=0)
        $page=$obj->page;
    else
        $page=1;

    $query.=" order by `category_id` desc limit {$limit} offset ".(($page-1)*$limit);

    if(isset($obj->category_id) && $obj->category_id!=""){
        $category_id=numOnly($obj->category_id);
        $query="select * from `category_audio` where `category_id`=".$category_id;
    }

    $result=mysqli_query($con,$query);
    if($result){
        //query success
        $output='{"status":"success", "dir_url":"'.$hostname.''.$audio_location.'", "audio_category":';
        while ($row=mysqli_fetch_assoc($result)){
            $category_id=$row["category_id"];
            
            $ob=new stdClass();
			$ob->category_id=$category_id;
            //$ob->status=1;
            $data=audioCategoryIdList($ob);
            $arr=json_decode($data);
            if(sizeof($arr)>=$min_range){
            	$row["url"]=$arr[0]->url;
            	$category_audio[]=$row;
            }
        }
        $output.=json_encode($category_audio);
        $output.=', "audio_list":'.audioCategoryIdList($obj);
        $output.='}';
        return $output;
    }else{
        //somthing problem with query
        return '{"status":"failure","remark":"somthing problem with the query", "query":"'.$query.'"}';
    }
}

function audioList($obj)
{
	//if audio_id is set, return detail of that audio
	//else return entire audio list
	//obj list audio_id, search, status, limit, page
	global $con,$hostname,$audio_location;
	$audio_list=array();
	$query="select v.*, c.name as 'category_name',c.status as 'category_status' from `audio` v join `category_audio` c where v.category_id=c.category_id and ";

	//for search
    if(isset($obj->search) && $obj->search!=""){
        $search=clean($obj->search);
        $count=1;
        while($count!=0)
            $search=str_replace("  "," ", $search,$count);
        
        $keywords=explode(" ", $search);
        $length=sizeof($keywords);
        if($length!=0)
        {
            for($i=0;$i<$length;$i++)
            {
                $query.=" (v.`name` like '%".$keywords[$i]."%') and ";
            }
        }
    }
  	
    if(isset($obj->status) && $obj->status=="1")
        $query.=" v.`status`=1 ";
    else if(isset($obj->status) && $obj->status=="0")
        $query.=" v.`status`=0 ";
    else $query.=" (v.`status`=0 or v.`status`=1) ";

    //for limit
    if(isset($obj->limit) && $obj->limit!=0)
        $limit=$obj->limit;
    else
        $limit=10;

    //for page
    if(isset($obj->page) && $obj->page!=0)
        $page=$obj->page;
    else
        $page=1;

    $query.=" order by v.`audio_id` desc limit {$limit} offset ".(($page-1)*$limit);

    if(isset($obj->audio_id) && $obj->audio_id!=""){
        $audio_id=numOnly($obj->audio_id);
        $query="select v.*, c.name as 'category_name' from `audio` v join `category_audio` c where v.category_id=c.category_id and v.audio_id=".$audio_id;
    }

    $result=mysqli_query($con,$query);
    if($result){
        //query success
        $output='{"status":"success", "dir_url":"'.$hostname.''.$audio_location.'", "audio_list":';
        while ($row=mysqli_fetch_assoc($result)){
            $audio_list[]=$row;
        }
        $output.=json_encode($audio_list);

        //for similar audio, code goes here
        if(isset($obj->audio_id) && $obj->audio_id!=""){
            $output.=', "audio_similar":';
            $audio_similar=array();

            $obj=new stdClass();
            $obj->status=1;
            $obj->category_id=$audio_list[0]["category_id"];
            $arr=json_decode(audioCategoryList($obj));
            if($arr->status=="success" && sizeof($arr->audio_list)>0){
                $count=0;
                while($count<=10 && sizeof($arr->audio_list)>$count){
                    $audio_similar[]=$arr->audio_list[$count];
                    $count+=1;
                }
            }
            $output.=json_encode($audio_similar);
        }
        $output.='}';
        return $output;
        // return $query;
    }else{
        //somthing problem with query
        return '{"status":"failure","remark":"somthing problem with the query", "query":"'.$query.'"}';
    }
}

function audioCategoryIdList($obj)
{
	//it return all the audio list which is under given category list else uncategory list
	global $con;
	$audio_list=array();

	$query="select * from `audio` where ";

	//for search
    if(isset($obj->search) && $obj->search!=""){
        $search=clean($obj->search);
        $count=1;
        while($count!=0)
            $search=str_replace("  "," ", $search,$count);
        
        $keywords=explode(" ", $search);
        $length=sizeof($keywords);
        if($length!=0)
        {
            for($i=0;$i<$length;$i++)
            {
                $query.=" (`name` like '%".$keywords[$i]."%') and ";
            }
        }
    }

    if(isset($obj->category_id) && $obj->category_id!=""){
    	$category_id=numOnly($obj->category_id);
    	$query.=" `category_id`='".$category_id."' and ";
    }else{
    	$category_id=0;
    	$query.=" `category_id`='".$category_id."' and ";
    }

  	
    if(isset($obj->status) && $obj->status=="1")
        $query.=" `status`=1 ";
    else if(isset($obj->status) && $obj->status=="0")
        $query.=" `status`=0 ";
    else $query.=" (`status`=0 or `status`=1) ";

    //for limit
    if(isset($obj->limit) && $obj->limit!=0)
        $limit=$obj->limit;
    else
        $limit=10;

    //for page
    if(isset($obj->page) && $obj->page!=0)
        $page=$obj->page;
    else
        $page=1;

    $query.=" order by `audio_id` desc limit {$limit} offset ".(($page-1)*$limit);
    $result=mysqli_query($con,$query);
    while($row=mysqli_fetch_assoc($result)){
		//$row["category_name"]="Uncategory";
		$audio_list[]=$row;
	}
	return json_encode($audio_list);
}

//*******************************************for event********************
function eventList($obj)
{
	//if event_id is set, return detail of that event
	//else return entire event list
	//obj list event_id, search, status, limit, page
	global $con,$hostname,$event_image_location;
	$event_list=array();
	$query="select * from `event` where ";

	//for search
    if(isset($obj->search) && $obj->search!=""){
        $search=clean($obj->search);
        $count=1;
        while($count!=0)
            $search=str_replace("  "," ", $search,$count);
        
        $keywords=explode(" ", $search);
        $length=sizeof($keywords);
        if($length!=0)
        {
            for($i=0;$i<$length;$i++)
            {
                $query.=" (`name` like '%".$keywords[$i]."%') and ";
            }
        }
    }
  	
    if(isset($obj->status) && $obj->status=="1")
        $query.=" `status`=1 ";
    else if(isset($obj->status) && $obj->status=="0")
        $query.=" `status`=0 ";
    else $query.=" (`status`=0 or `status`=1) ";

    //for limit
    if(isset($obj->limit) && $obj->limit!=0)
        $limit=$obj->limit;
    else
        $limit=10;

    //for page
    if(isset($obj->page) && $obj->page!=0)
        $page=$obj->page;
    else
        $page=1;

    $query.=" order by `event_id` desc limit {$limit} offset ".(($page-1)*$limit);

    if(isset($obj->event_id) && $obj->event_id!=""){
        $event_id=numOnly($obj->event_id);
        $query="select * from `event` where `event_id`=".$event_id;
    }

    $result=mysqli_query($con,$query);
    if($result){
        //query success
        $output='{"status":"success", "dir_url":"'.$hostname.''.$event_image_location.'", "event_list":';
        while ($row=mysqli_fetch_assoc($result)){
            $row["date"]=date("d M Y",strtotime($row["datetime"]));
            $row["time"]=date("H:i",strtotime($row["datetime"]));
            $row["date_time"]=date("d M,Y @ g:i A",strtotime($row["datetime"]));
            $event_list[]=$row;
        }
        $output.=json_encode($event_list);
        if(isset($obj->event_id) && $obj->event_id!=""){
            $output.=', "event_similar":';
            $event_similar=array();

            $obj=new stdClass();
            $obj->status=1;
            $arr=json_decode(eventList($obj));
            if($arr->status=="success" && sizeof($arr->event_list)>0){
                $count=0;
                while($count<=10 && sizeof($arr->event_list)>$count){
                    $event_similar[]=$arr->event_list[$count];
                    $count+=1;
                }
            }
            $output.=json_encode($event_similar);
        }
        $output.='}';
        return $output;
    }else{
        //somthing problem with query
        return '{"status":"failure","remark":"somthing problem with the query", "query":"'.$query.'"}';
    }
}

//********************************************for wishlist
function wishlistUser($user_id)
{
    global $con,$hostname,$audio_location,$image_location,$event_image_location;

    //obj_list user_id
    if(isset($user_id) && $user_id!=""){
        //user_id recieved
        $video_list=array();
        $audio_list=array();
        $image_list=array();
        $event_list=array();

        $query="select * from `wishlist` where `user_id`=".$user_id;
        $result=mysqli_query($con,$query);
        if($result){
            // $output='{"status":"success", }';
            // $row_count=mysqli_num_rows($result);
            while($row=mysqli_fetch_assoc($result)){
                $video_id=$row["video_id"];
                $audio_id=$row["audio_id"];
                $image_id=$row["image_id"];
                $event_id=$row["event_id"];

                if($video_id!=0){
                    $obj=new stdClass();
                    $obj->video_id=$video_id;
                    $obj->status=1;
                    $arr=json_decode(videoList($obj));
                    if($arr->status=="success" && sizeof($arr->video_list)>0)
                        $video_list[]=$arr->video_list[0];
                }
                if($audio_id!=0){
                    $obj=new stdClass();
                    $obj->audio_id=$audio_id;
                    $obj->status=1;
                    $arr=json_decode(audioList($obj));
                    if($arr->status=="success" && sizeof($arr->audio_list)>0)
                        $audio_list[]=$arr->audio_list[0];
                }
                if($image_id!=0){
                    $obj=new stdClass();
                    $obj->image_id=$image_id;
                    $obj->status=1;
                    $arr=json_decode(imageList($obj));
                    if($arr->status=="success" && sizeof($arr->image_list)>0)
                        $image_list[]=$arr->image_list[0];
                }
                if($event_id!=0){
                    $obj=new stdClass();
                    $obj->event_id=$event_id;
                    $obj->status=1;
                    $arr=json_decode(eventList($obj));
                    if($arr->status=="success" && sizeof($arr->event_list)>0)
                        $event_list[]=$arr->event_list[0];
                }
            }
            return '{"status":"success", "video_list":'.json_encode($video_list).', "audio_dir_url":"'.$hostname.''.$audio_location.'", "audio_list":'.json_encode($audio_list).', "image_dir_url":"'.$hostname.''.$image_location.'", "image_list":'.json_encode($image_list).', "event_dir_url":"'.$hostname.''.$event_image_location.'", "event_list":'.json_encode($event_list).'}';
        }else{
            return '{"status":"failure","remark":"somthing problem with the query"}';
        }
    }else{
        return '{"status":"failure","remark":"Invalid or incomplete user id recieved"}';
    }
}


//*******************************************for slider_top********************
function slider_top_list($obj)
{
    if(isset($obj->search)){
                
                global $con;
                $top_list=array();

                
                $query="select v.*, c.name as 'image_name',c.status as 'image_status' from `slider_top` v join `image` c where v.img_id=c.image_id and v.status=1 and";

                
                if(isset($obj->search) && $obj->search!=""){
                     $search=clean($obj->search);
                     $count=1;
                     while($count!=0)
                         $search=str_replace("  "," ", $search,$count);
                    
                     $keywords=explode(" ", $search);
                     $length=sizeof($keywords);
                     if($length!=0)
                     {
                         for($i=0;$i<$length;$i++)
                         {
                             $query.=" (c.`name` like '%".$keywords[$i]."%')";
                         }
                     }
                 }

                
                //for limit
                if(isset($obj->limit) && $obj->limit!=0)
                    $limit=$obj->limit;
                else
                    $limit=10;

                //for page
                if(isset($obj->page) && $obj->page!=0)
                    $page=$obj->page;
                else
                    $page=1;

                //$query.=" order by `slider_top_id` desc limit {$limit} offset ".(($page-1)*$limit);
                $result=mysqli_query($con,$query);
                $rowcount=mysqli_num_rows($result);
                if($rowcount>0){
                    while($row=mysqli_fetch_assoc($result)){
                        //$row["category_name"]="Uncategory";
                        $top_list[]=$row;
                    }
                    return '{"status":"success", "slider_top_list":'.json_encode($top_list).'}';
                }
                else{
                    $a='{"status":"Image not in slider_top"}';
                    echo $a;
                }
                


    }
    else{

                
                global $con;
                $top_list=array();

                // $query="select * from `slider_top` ";
                $query="select v.*, c.name as 'image_name',c.status as 'image_status' from `slider_top` v join `image` c where v.img_id=c.image_id and v.status=1";

                

                //for limit
                if(isset($obj->limit) && $obj->limit!=0)
                    $limit=$obj->limit;
                else
                    $limit=10;

                //for page
                if(isset($obj->page) && $obj->page!=0)
                    $page=$obj->page;
                else
                    $page=1;

                //$query.=" order by `slider_top_id` desc limit {$limit} offset ".(($page-1)*$limit);
                $result=mysqli_query($con,$query);
                while($row=mysqli_fetch_assoc($result)){
                    //$row["category_name"]="Uncategory";
                    $top_list[]=$row;
                }
                return '{"status":"success", "slider_top_list":'.json_encode($top_list).'}';
            }
}





//*******************************************for slider_bottom********************
function slider_bottom_list($obj)
{
    if(isset($obj->search)){
                
                global $con;
                $bottom_list=array();

                
                $query="select v.*, c.name as 'image_name',c.status as 'image_status' from `slider_bottom` v join `image` c where v.img_id=c.image_id and v.status=1 and";

                
                if(isset($obj->search) && $obj->search!=""){
                     $search=clean($obj->search);
                     $count=1;
                     while($count!=0)
                         $search=str_replace("  "," ", $search,$count);
                    
                     $keywords=explode(" ", $search);
                     $length=sizeof($keywords);
                     if($length!=0)
                     {
                         for($i=0;$i<$length;$i++)
                         {
                             $query.=" (c.`name` like '%".$keywords[$i]."%')";
                         }
                     }
                 }

                
                //for limit
                if(isset($obj->limit) && $obj->limit!=0)
                    $limit=$obj->limit;
                else
                    $limit=10;

                //for page
                if(isset($obj->page) && $obj->page!=0)
                    $page=$obj->page;
                else
                    $page=1;

                //$query.=" order by `slider_top_id` desc limit {$limit} offset ".(($page-1)*$limit);
                $result=mysqli_query($con,$query);
                $rowcount=mysqli_num_rows($result);
                if($rowcount>0){
                    while($row=mysqli_fetch_assoc($result)){
                        //$row["category_name"]="Uncategory";

                        $bottom_list[]=$row;
                    }
                    return '{"status":"success", "slider_bottom_list":'.json_encode($bottom_list).'}';
                }
                else{
                    $a='{"status":"Image not in slider_bottom"}';
                    echo $a;
                }

    }
    else{

                
                global $con;
                $bottom_list=array();

                // $query="select * from `slider_top` ";
                $query="select v.*, c.name as 'image_name',c.status as 'image_status' from `slider_bottom` v join `image` c where v.img_id=c.image_id and v.status=1";

                

                //for limit
                if(isset($obj->limit) && $obj->limit!=0)
                    $limit=$obj->limit;
                else
                    $limit=10;

                //for page
                if(isset($obj->page) && $obj->page!=0)
                    $page=$obj->page;
                else
                    $page=1;

                //$query.=" order by `slider_top_id` desc limit {$limit} offset ".(($page-1)*$limit);
                $result=mysqli_query($con,$query);
                while($row=mysqli_fetch_assoc($result)){
                    //$row["category_name"]="Uncategory";
                    $bottom_list[]=$row;
                }
                return '{"status":"success", "slider_bottom_list":'.json_encode($bottom_list).'}';
            }
}







//********************************************for similer product
/*function similarProduct($table,$product_id)
{
    global $con;
    $column="";
    if($table=="video"){
        $table="video";
        $column="video_id";
    }elseif($table=="audio"){
        $table="audio";
        $column="audio_id";
    }elseif($table=="image"){
        $table="image";
        $column="image_id";
    }elseif($table=="event"){
        $table="event";
        $column="event_id";
    }else{
        return '{"status":"failure", "remark":"Invalid or incomplete table name"}';
    }

    $product=array();
    if($product_id!=""){
        $query="select * from `{$table}` where `{$column}`=".$product_id;
        $result=mysqli_query($con,$query);
        if($result){
            if(mysqli_num_rows($result)==1){
                $row=mysqli_fetch_assoc($result);
                $category_id=$row["category_id"];
                if($category_id!=""){

                }
                $obj=new stdClass();
                $obj->$column=$product_id;
                $obj->status=1;
                $arr=json_decode(videoList($obj));
            }else{
                return '{"status":"failure","remark":"Sorry, There is no such type of product"}';
            }
        }else{
            return '{"status":"failure","remark":"Something is wrong with query"}';
        }
    }else{
        return '{"status":"failure","remark":"Invalid or incomplete product id recieved"}';
    }
}*/

?>