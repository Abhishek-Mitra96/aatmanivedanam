<?php require_once ('theme/header_1.php'); ?>


<?php require_once ('theme/header_2.php'); ?>

<?php require_once ('theme/sidebar.php'); ?>
<?php
$obj=new stdClass();
$obj->viewall=1;
$brands=json_decode(brandList($obj));
?>
 <style>
   .error{
    color: red;
    display: inline;
   }
 </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Download Excel File</h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      
      <div class="box box-primary">

            <div class="box-body">


                <form name="product_insert" action="generate_excel.php" method="POST">    
                    
                <div class="form-horizontal">
   
                    
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Brand Name</label>
                        <div class="col-sm-6" id="brand_loc">
                        <?php
                        if($brands->status=="success")
                         {
                              $out='<select class="form-control" id="brand_id" name="brand_name">';
                              $out.="<option value='null'>Select Brand</option>";
                              for($i=0;$i<sizeof($brands->brands);$i++){
                                  
                                  $out.= "<option value=" . $brands->brands[$i]->brand_name . ">" ;
                                  $out.= $brands->brands[$i]->brand_name;
                                  $out.= "</option> ";
                              }
                               $out.='</select>';
                              echo $out;
                          }

                        ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Primary Category</label>
                        <div class="col-sm-6" id="category_primary">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Secondary  Category</label>
                        <div class="col-sm-6" id="category_secondary">

                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-sm-2 control-label">Tertiary Category</label>
                        <div class="col-sm-6" id="category_tertiary">

                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Quaternary Category</label>
                        <div class="col-sm-6" id="category_quaternary">

                        </div>
                    </div>
  -->
                    
                    


                    <div class="box-footer">
                      <center> <input type="submit" style="width:20%" class=" Submit btn btn-primary submit_btn" name="submit" id="submit" value="submit"> </center>
                    </div><!-- /.box-footer -->
                      
                       
                      
               </div><!-- /.box-body -->
 
              </form>
                 
                </div> 
                
                
            </div>
      
      
      <!-- /.box -->
       
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
  
  
  <?php require_once ('theme/footer.php');?>

    <script>

      
      /* For Primary Category */
      $.getJSON("../adminapi/category/category_list.php",
           function(data2)
           {

                 data2=JSON.stringify(data2);
                 var arr2=JSON.parse(data2);
                 if(arr2.status=="success")
                 {
                 var x2;
                 var out='<select class="form-control" id="primary_category_id" name="primary_category_id">';
                 out += "<option value='null'>Select Category</option>";
                 for(x2=0;x2<arr2.categories.length;x2++)
                    {
                      out+="<option value="+arr2.categories[x2].id+"> "+arr2.categories[x2].category_name+"</option> ";
                    }
                    out+='</select>';
                    document.getElementById("category_primary").innerHTML=out;
                  }
                });
      /* For Secondary Category */

      $('#category_primary').on('change', function() {
               var primary_id=$('#primary_category_id').val();
               // alert(primary_id);
               $.ajax({
                  type:'POST',
                  url:'../adminapi/category/category_list.php',
                  data:{
                     parent_id : primary_id
                  },
                  success:function(data2)
                  {
                    //data2=JSON.stringify(data2);
                    // console.log(data2)
                    var arr2=JSON.parse(data2);
                    if(arr2.status=="success")
                    {
                    var x2;
                    var out='<select class="form-control" id="secondary_category_id" name="secondary_category_id">';
                    out += "<option value='null'>Select Secondary Category</option>";
                    for(x2=0;x2<arr2.categories.length;x2++)
                       {
                         out+="<option value="+arr2.categories[x2].id+"> "+arr2.categories[x2].category_name+"</option> ";
                       }
                       out+='</select>';
                       document.getElementById("category_secondary").innerHTML=out;
                       //document.getElementById("category_tertiary").innerHTML="";
                    }
                    else
                    {
                       document.getElementById("category_secondary").innerHTML="";
                    }
                  }
               });

       });
</script>