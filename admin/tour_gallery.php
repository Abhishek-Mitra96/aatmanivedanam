<?php require_once ('theme/header_1.php'); ?>


<?php require_once ('theme/header_2.php'); ?>

<?php require_once ('theme/sidebar.php'); 

$id=$_GET["id"];

$obj=new stdClass();
$obj->tour_id=$id;

$data=json_decode(tourDetails($obj));

// echo $data;

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
      <h1>Upload images for the Gallery</h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      
      <div class="box box-primary">

            <div class="box-body">


                <form method="post" enctype="multipart/form-data" action="tour_gallery_2.php" onsubmit="return validate()">
                  <input type="hidden" name="tour_id" value="<?php echo $id;?>">
                  <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tour Name</label>
                        <div class="col-sm-6">
                            <?=$data->tour[0]->tour_name;?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Vendor Name</label>
                        <div class="col-sm-6">
                            <?=$data->tour[0]->vendor_name;?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Select Images</label>
                        <div class="col-sm-6">
                            <input type="file" name="images[]" multiple>
                        </div>
                    </div>

                  
                  </div>
                  <div class="box-footer">
                   <input type="submit" style="width:20%" class=" Submit btn btn-primary" name="submit" value="Submit"> <a href="tour.php" class="btn btn-warning">Skip</a>
                 </div>
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
       
function validate()
  {

    var arrayExtensions = ["jpg" , "jpeg", "png"];
    var files = $('input[type=file]').get(0).files;

    if(files.length==0)
    {
      toast("You have not selected any file for upload");
      return false; 
    }

    for (i = 0; i < files.length; i++)
    {
      //check for file extension
      var ext = files[i].name.split(".");
      ext = ext[ext.length-1].toLowerCase(); 

      if (arrayExtensions.lastIndexOf(ext) == -1) {
        toast("Only JPG or PNG images allowed");
        return false;
      }

        //check for file size
       if(files[i].size > 307200)
       {
        toast("All images should be within 300KB");
        return false;
       }
    }
   return true;
  }

</script>