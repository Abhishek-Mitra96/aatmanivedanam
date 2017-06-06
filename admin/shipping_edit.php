<?php 
require_once '../include/config.php';
require_once ('theme/header_1.php'); 
?>
<?php require_once ('theme/header_2.php'); ?>
<?php require_once ('theme/sidebar.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

<?php $id = $_REQUEST['id'];?>
<section class="content">
              
              <h1>Shipping Details</h1>
          
          <div class="box box-primary">

            <div class="box-body">
  
                <div class="form-horizontal">
                      
                       <div class="form-group">
<!--                      <label  class="col-sm-2 control-label">id</label>-->
                      <div class="col-sm-6">
                          <input type="hidden" class="form-control" id="shipping_id" name="shipping_id" value="<?php echo $id ; ?>">
                      </div>
                    </div>
               

                       <div class="form-group">
                      <label  class="col-sm-2 control-label">order_id</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" id="order_id" name="order_id" value="">
                      </div>
                    </div>
               

                       <div class="form-group">
                      <label  class="col-sm-2 control-label">Courier name</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" id="courier_name" name="courier_name" value="">
                      </div>
                    </div>

                     <div class="form-group">
                      <label  class="col-sm-2 control-label">Date</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" placeholder="" id="date" name="date" value="">
                      </div>
                    </div>

                     <div class="form-group">
                      <label  class="col-sm-2 control-label">Position</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" placeholder="" id="position" name="position" value="">
                      </div>
                    </div>
                      
                       <div class="form-group">
                      <label  class="col-sm-2 control-label">Date of delivery</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" placeholder="" id="delivery" name="delivery" value="">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-6">
                          <select class="form-control" id="status" name="status">
                          <option value= "Active"> Active</option>
                          <option value= "Inactive">Inactive</option>
                          </select>
                        </div>
                    </div>
                    
                    

               </div><!-- /.box-body -->
                  <div class="box-footer">
                     <center> <input type="submit" style="width:20%" class=" Submit btn btn-primary submit_btn" name="submit" value="submit"> </center>
                    <!--  <input class="Submit btn btn-primary" name="Submit" value="Submit" > -->
                    
                  </div><!-- /.box-footer -->
                </div> 
                
                
            </div><!-- /.box-body -->
            <div class="box-footer">                 </div>
          </div><!-- /.box -->

        </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
  
  
  <?php require_once ('theme/footer.php');?>
  <script>

  $(document).ready(function(){

    $.getJSON("../adminapi/shipping/shipping_fetch.php?id="+<?php echo $id ?>,
    function(data)
    {
       data=JSON.stringify(data);
       var arr=JSON.parse(data);
      // var id = arr[0].id;
       var order_id=arr[0].order_id;
       var courier_name=arr[0].courier_name ;
       var date=arr[0].date;
       var position=arr[0].position;
       var delivery=arr[0].date_of_delivery;
      // $('#id').val(id);
       $('#order_id').val(order_id);
       $('#courier_name').val(courier_name);
       $('#date').val(date);
       $('#position').val(position);
       $('#delivery').val(delivery);
    }
  );


    $('.submit_btn').click(function(){
        var order_id=$('#order_id').val();
        var courier_name=$('#courier_name').val();
        var date=$('#date').val();
        var position=$('#position').val();
        var delivery=$('#delivery').val();
        var id=$('#shipping_id').val();
        var status=$('#status').val();
       // alert(id);
     $.ajax({
                       type: 'POST',
                       url: '../adminapi/shipping/shipping_edite.php',
                       data: {
                        id:id,
                        order_id:order_id,
                        courier_name:courier_name,
                        date:date,
                        position:position,
                        delivery:delivery,
                        status:status
                          },
                       success: function(data) {
                           
                         //  alert(data); 
                         if (data == 1)
                           {
                               alert('Edited successfully!');
                               location.href="shipping.php";
                           }
                           else{
                               alert('Error!');
                           }
                               
                       }
                       

                   });
        });
  });
  </script>