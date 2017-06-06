<?php 
 require_once '../include/config.php';
require_once ('theme/header_1.php'); 
require_once ('theme/header_2.php'); 
require_once ('theme/sidebar.php');




$query_1="select t1.id , t1.category_name as lev1, t2.category_name as lev2, t3.category_name as lev3, t4.category_name as lev4,"
            . " t1.category_description,t1.category_image,t1.url,t1.status"
            . " from master_category AS t1 "
            . "left join master_category AS t2 on t2.parent_id = t1.id "
            . "left join master_category AS t3 on t3.parent_id = t2.id "
            . "left join master_category AS t4 on t4.parent_id = t3.id";
    
    $result1 = mysqli_query($con,$query_1);
  $total_row =  mysqli_affected_rows($con);
  unset($query_1);  unset($result1);
//  echo $total_row;
//  die();
    
    $rec_count= $total_row;



 $rec_limit = 5;
         
    if( isset($_GET{'page'} ) ) {
       $page = $_GET{'page'} + 1;
       $offset = $rec_limit * $page ;
    }else {
       $page = 0;
       $offset = 0;
    }



    $left_rec = $rec_count - ($page * $rec_limit);


?>
 

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      

      <h1> Category Page
             
              <a href="mastercategory_insert.php" class="btn btn-info pull-right" role="button">Add Category</a>
             </h1>
    </section>

    <!-- Main content -->
 <section class="content">

       <div class="box box-primary">
            <div class="box-body table-responsive no-padding">
               
            <div id="content">
                  </div>             

                  
            </div>
            <div class="box-footer">
            </div>
          </div>

<!--     /////////////////////-->
     <?php
      if( $page > 0 )
             {
                $last = $page - 2;
                ?>
               <a href = "<?php echo $_SERVER['PHP_SELF'] ;?>?page=<?php echo $last ;?>">Last 10 Records</a>;
               <a href = "<?php echo $_SERVER['PHP_SELF'] ;?>?page=<?php echo $page ;?>">Next 10 Records</a>;

           <?php  }
         
         else if( $page == 0 )
             {
             ?>

               <a href = "<?php echo $_SERVER['PHP_SELF'] ;?> ?page=<?php echo $page ;?>">Next 10 Records</a>;
             
          <?php   }
         else if( $left_rec < $rec_limit )
             {
                $last = $page - 2;
                ?>
                
               <a href = "<?php echo $_SERVER['PHP_SELF'] ;?> ?page=<?php echo $last ;?>">Last 10 Records</a>;
                
           <?php   }
         
     
     ?>
     
     
     
     
     
     
     
     
     
     
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

  
  

  <?php
  require_once ('theme/footer.php');
  ?>
<!--  <script src="../assets/bootstrap/js/myjs.js"></script>-->
  <script>
  $.getJSON("../adminapi/Master_Category/mastercategory_view_test.php",
    function(data)
    {
    data=JSON.stringify(data);
    var arr=JSON.parse(data);
    var x;
    var out="<div class=\"box box-primary\"><div class=\"box-body table-responsive no-padding\">";
        out+="<div id=\"content\"></div>";
        out+="<table class=\'table table-hover\'><tbody>";
        out+="<tr>";
        
        out+="<th>lev1</th>";
        out+="<th>lev2</th>";
        out+="<th>lev3</th>";
        out+="<th>lev4</th>";
        
        out+="<th>category_description</th>";
        
        out+="<th>category_image</th>";
        
//        out+="<th>category_icon</th>";
        out+="<th>url</th>";
//        out+="<th>category_priority</th>";
        out+="<th>status</th>";
        
        out+="<th>Action</th>";
        out+="</tr>";
    
    
    
    for(x=0;x<arr.length;x++)
        {
            out+="<tr>";
            out+="<td>"+arr[x].lev1+"</td>";
            out+="<td>"+arr[x].lev2+"</td>";
            out+="<td>"+arr[x].lev3+"</td>";
            out+="<td>"+arr[x].lev4+"</td>";
            out+="<td>"+arr[x].category_description+"</td>";
            out+="<td><img src=../assets/image/category/"+arr[x].category_image+" height='50px' width='80px'></td>"
            out+="<td>"+arr[x].url+"</td>";

            //out+="<td>"+arr[x].status+"</td>";
            out+="<td><a href='../adminapi/Master_Category/mastercategory_Deleted_Active.php?id="+arr[x].id+"'onclick=\"return confirm('Are you sure you want to change status "+arr[x].status+"?');\"> "+arr[x].status+"</a>";

            out+="<td><a href='mastercategory_edit.php?id="+arr[x].id+"'class='label label-success' data-toggle='tooltip' title='Edit Site User'><i class='fa fa-pencil-square-o'></i> Edit</a>";
            out+="<a href='../adminapi/Master_Category/mastercategory_delete.php?id="+arr[x].id+"' class='label label-danger' onclick=\"return confirm('Are you sure you want to delete this item?');\" data-toggle='tooltip' title='Delete Site User' data-confirm='#''><i class='fa fa-trash'></i> Delete</a></td>";
            out+="</tr>";
        }
   out+="</tbody></table></div>";
   document.getElementById("content").innerHTML=out;
    }
  );



 </script>