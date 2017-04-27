<?php 

require_once ('theme/header_1.php'); 
require_once ('theme/header_2.php'); 
require_once ('theme/sidebar.php');

//checkdata("1","1","1");
$obj=new stdClass();

$image_category=json_decode(imageCategoryList($obj));
?>
</section>

<div class="content-wrapper">
      
  <section class="content-header">
    <h1>Add Image
    <button class="btn btn-info pull-right" data-toggle="modal" data-target="#add_category">Add Category</button>
    <!-- <a href="" class="btn btn-info pull-right" role="button" data-toggle="modal" data-target="#edit">Edit Category</a> -->
  </section>
      
  <section class="content">
    <div class="box box-primary" id="box-widget">
      <!-- <div class="box-header"></div> -->
          
      <!-- <div class="divide20"></div> -->
      <div class="box-body">
        <div class="row">
          <h2 class="text-center">Choose the category</h2>
        </div>
        <div class="row">
          <div class="col-sm-2"></div>
          <div class="col-sm-8">
            <div class="divide20"></div>
            <div class="form-group">
              <select class="form-control chosen-select" id="category_list" name="category_list[]" tabindex="3">
                  <?php
                      for($i=0;$i<sizeof($image_category->image_category);$i++){
                          echo '<option value="'.$image_category->image_category[$i]->category_id.'">'.$image_category->image_category[$i]->name.'</option>';
                      }
                  ?>
              </select>
            </div>
          </div>
          <div class="col-sm-2"></div>
        </div>
        <div class="divide20"></div>
        
        <div class="row">
          <div class="col-xs-2"></div>
          <div class="col-xs-8">
            <table class="table table-striped">
              <tr>
                <td><b>Image Name</b></td>
                <td><input type="text" name='add_image_name' id="add_image_name"  placeholder='Image Name' class="form-control"/></td>
              </tr>
              <tr>
                <td><b>Discription</b></td>
                <td><textarea name="add_image_description" id="add_image_description" placeholder="Description" rows="3" class="form-control"></textarea></td>
              </tr>
              <tr>
                <td><b>Image File</b></td>
                <td><input type="file" name='add_image_file' id="add_image_file" class="form-control"/></td>
              </tr>
            </table>
          </div>
          <div class="col-xs-2"></div>
        </div>
        <div class="row">
          <center><button class="btn btn-primary" onclick="add_image()">Add Image</button></center>
        </div>
      </div>

      <!-- <div class="box-footer"></div> -->
    </div>

  </section>
</div>
<?php require_once ('theme/footer.php');?>

<!--EDIT Modal -->
<div id="add_category" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Category</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <table class="table">
            <tr><th class="col-xs-3"></th><th class="col-xs-9"></th></tr>
            <tr>
              <td><b>Category Name</b></td>
              <td><input type="text" class="form-control" id="add_category_name" placeholder="Category Name"></td>
            </tr>
            <tr>
              <td><b>Description</b></td>
              <td><textarea class="form-control" id="add_category_description" placeholder="Discription" rows="3"></textarea></td>
            </tr>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="add_category()" data-dismiss="modal">Add Category</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>

/*$(document).ready(function(){
  var i=1;
     $("#add_row").click(function(){
      $('#video'+i).html("<td>"+ (i+1) +"</td><td><input name='name"+i+"' type='text' placeholder='Name' class='form-control input-md'  /> </td><td><textarea name='description"+i+"' placeholder='Description' rows='1' class='form-control'></textarea></td><td><select class='form-control' name='status"+i+"'><option value='1' selected>Active</option><option value='0'>Inactive</option></select></td>");

      $('#video_table').append('<tr id="video'+(i+1)+'"></tr>');
      i++; 
  });
     $("#delete_row").click(function(){
       if(i>1){
     $("#video"+(i-1)).html('');
     i--;
     }
   });

});*/

function add_category(){
  var name,description;
  name=$("#add_category_name").val();
  description=$("#add_category_description").val();

  if(name!="" && description!=""){
    $.ajax({
        type: 'POST',
        url: '../adminapi/image/category_add.php',
        data: {
              name:name,
              description:description
            },
        success: function(data) {
          console.log(data);
          var arr=JSON.parse(data);
          if(arr["status"]=="success"){
            toast("Add successfully");
            location.reload();
          }else{
            swal("Error",arr["remark"],"error");
          }
        }
    });
  }else{
    swal("Warning","Category name and description is must","warning");
  }
}

function add_image(){
  var name,file,description,category_id;
  name=$("#add_image_name").val();
  file=$("#add_image_file").val(); 
  description=$("#add_image_description").val();
  category_id=$("#category_list").val();
  //console.log(file);

  if(name!="" && description!="" && file!="" && category_id!=""){
    if(validate()){
      var filedata = $('#add_image_file').prop('files')[0];
      var formdata = new FormData();
      formdata.append('url' , filedata);
      formdata.append('name' , name);
      formdata.append('description' , description);
      formdata.append('category_id' , category_id);
      //console.log(formdata);
      $.ajax({
            type: 'post',
            url : '../adminapi/image/image_add.php',
            cache: false,
            contentType: false,
            processData: false,
            data  :  formdata,
            success : function(data){
                console.log(data);
                var arr=JSON.parse(data);
                if(arr["status"]=="success"){
                  toast("Add successfully");
                  location.reload();
                }else{
                  swal("Error",arr["remark"],"error");
                }
            }
        });
    }
  }else{
    swal("Warning","All Field are required","warning");
  }
}

function validate()
{
  var arrayExtensions = ["jpg" , "jpeg", "png"];
  var files = $('#add_image_file').get(0).files;

  if(files.length==0){
    toast("You have not selected any file for upload");
    return false; 
  }

  for (i = 0; i < files.length; i++){
    //check for file extension
    var ext = files[i].name.split(".");
    ext = ext[ext.length-1].toLowerCase(); 

    if (arrayExtensions.lastIndexOf(ext) == -1) {
      toast("Only JPG or PNG or JPEG images allowed");
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