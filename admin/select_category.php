<?php require_once ('theme/header_1.php'); ?>


<?php require_once ('theme/header_2.php'); ?>

<?php require_once ('theme/sidebar.php'); ?>
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
      <h1>Select Category</h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      
      <div class="box box-primary">

            <div class="box-body">


                <form name="tour_insert" action="tour_insert.php" method="get">    
                    
                <div class="form-horizontal">
   
                    
                    
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
                    
                    <input type="hidden" id="category_id" name="category_id">

                    <div class="box-footer">
                      <center> <input type="submit" style="width:20%; display:none;" class=" Submit btn btn-primary submit_btn" id="submit" value="submit"> </center>
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

      

      $.post("../adminapi/category/category_list.php",
      {
        nolimit:1,
        viewall:1
      },
      function(data2)
      {
           var arr2=JSON.parse(data2);
           if(arr2.status=="success")
           {
           var x2;
           var out='<select class="form-control" id="primary_category_id">';
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
               $("#category_id").val(primary_id);
               // alert(primary_id);
               $.ajax({
                  type:'POST',
                  url:'../adminapi/category/category_list.php',
                  data:{
                     parent_id : primary_id,
                     nolimit : 1
                  },
                  success:function(data2)
                  {
                    //data2=JSON.stringify(data2);
                    // console.log(data2)
                    var arr2=JSON.parse(data2);
					//console.log(arr2);
                    if(arr2.status=="success")
                    {
                    var x2;
                    var out='<select class="form-control" id="secondary_category_id">';
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
					   $('#submit').show();
					   
                    }
                  }
               });

       });

      $("body").on("change","#secondary_category_id",function()
      {
        var primary_id=$('#secondary_category_id').val();
               $("#category_id").val(primary_id);
      })
	  
	  $('#category_secondary').change(function(){
		   $('#submit').show();
	  });
</script>