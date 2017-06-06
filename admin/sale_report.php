<?php require_once ('theme/header_1.php'); ?>


<?php require_once ('theme/header_2.php'); ?>

<?php require_once ('theme/sidebar.php'); 

    $date=date("Y-m-d");
?>
<style>
  th,td{
    text-align: center!important;
  }
</style>
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sale Report
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box --> 
      <div class="box box-primary">
          
          
          
          
            <div class="box-body table-responsive no-padding">

                <div style="padding: 20px;">
                  From &nbsp;&nbsp;<input type="date" id="dateStart" style="width:auto!important" value="<?php echo $date; ?>"> &nbsp;&nbsp;To&nbsp;&nbsp; <input type="date" id="dateStop" style="width:auto!important" value="<?php echo $date; ?>"> &nbsp; <button class="btn btn-info salesReport">Submit</button>
                </div>
                <div class="divide20"></div>

                <div class="col-md-5 col-md-offset-1">
                  <div id="content">
                  </div>
                </div>
                  
            </div>
            <div class="box-footer">
            </div>
          </div>
 
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php

   require_once ('theme/footer.php');
   ?>
   <script>
     function myFunction(arr) 
{
    if(arr.status=="success")
    {
        var out = '<table id="myTable" class="table table-bordered">';
        out+='<thead><tr><th>Date</th><th>Sale</th></tr></thead><tbody>';
        var i;
        for(i = 0; i < arr.summary.length; i++) 
        {
            out += '<tr id="client"><td>'+arr.summary[i].date+'</td><td>'+arr.summary[i].amount+'</td></tr>';
        }
        out+='</tbody></table>';
        out+='<table><tr>'
        out+='<td>Total Sale </td><td> : '+arr.total_sale+'/-</td>';
        out+='</table>';
    }
    else
    {
      out=arr.remarks;
    }
    document.getElementById("content").innerHTML = out;

    // showChart(arr.summary);    //hide graph for now

} 
   </script>