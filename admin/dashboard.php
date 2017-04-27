<?php require_once ('theme/header_1.php'); ?>
<?php require_once ('theme/header_2.php'); ?>
<?php require_once ('theme/sidebar.php'); ?>
<style>
	h5{
		font-weight: bold;
	}
</style>
<div class="content-wrapper">
   <section class="content-header">
      <!-- <h1>
         ADMIN PANEL
         <small>it all starts here</small>
      </h1> -->
   </section>
   <section class="content">
<!--      <img src="../assets/image/ecommerce1.png" width="95%;margin-top:-20px">-->

	<div class="container">
	<div class="col-md-12">
		<div class="row well well-sm"><!-- for first row-->
			<div class="col-sm-3" >
				<center>
					<h5>Total Admins</h5>
					<h3 id="total_admin"><i class="fa fa-spinner" aria-hidden="true"></i></h3>
				</center>
			</div>
			<div class="col-sm-3">
				<center>
					<h5>Verified Users</h5>
					<h3 id="total_verified_user"><i class="fa fa-spinner" aria-hidden="true"></i></h3>
				</center>
			</div>
			<div class="col-sm-3">
				<center>
					<h5>Unverified Users</h5>
					<h3 id="total_unverified_user"><i class="fa fa-spinner" aria-hidden="true"></i></h3>
				</center>
			</div>
			<div class="col-sm-3">
				<center>
					<h5>Blocked Users</h5>
					<h3 id="total_blocked_user"><i class="fa fa-spinner" aria-hidden="true"></i></h3>
				</center>
			</div>
		</div>
		
		<div class="row"> <!-- for 2nd row data-->
			<div class="col-sm-6 well well-sm" style="padding-left:5%;padding-right:5%;">
				<div class="row"> <!-- todays order history-->
					<center><h5>Today's Order History</h5></center>
				</div>
				<div class="row">
					<div class="col-sm-6"><h5>New Orders</h5></div>
					<div class="col-sm-1"><h5>:</h5></div>
					<div class="col-sm-5"><h4 id="total_today_new_order" style="float:right"><i class="fa fa-spinner" aria-hidden="true"></i></h4></div>
				</div>
				<div class="row">
					<div class="col-sm-6"><h5>In Process Orders</h5></div>
					<div class="col-sm-1"><h5>:</h5></div>
					<div class="col-sm-5"><h4 id="total_today_in_process_order" style="float:right"><i class="fa fa-spinner" aria-hidden="true"></i></h4></div>
				</div>
				<div class="row">
					<div class="col-sm-6"><h5>Dispatched Orders</h5></div>
					<div class="col-sm-1"><h5>:</h5></div>
					<div class="col-sm-5"><h4 id="total_today_in_dispatch_order" style="float:right"><i class="fa fa-spinner" aria-hidden="true"></i></h4></div>
				</div>
				<div class="row">
					<div class="col-sm-6"><h5>Delivered Orders</h5></div>
					<div class="col-sm-1"><h5>:</h5></div>
					<div class="col-sm-5"><h4 id="total_today_delivered_order" style="float:right"><i class="fa fa-spinner" aria-hidden="true"></i></h4></div>
				</div>
				<div class="row">
					<div class="col-sm-6"><h5>Cancelled Orders</h5></div>
					<div class="col-sm-1"><h5>:</h5></div>
					<div class="col-sm-5"><h4 id="total_today_cancel_order" style="float:right"><i class="fa fa-spinner" aria-hidden="true"></i></h4></div>
				</div>

				<div class="row">
					<div class="col-sm-6"><h4>Total Orders</h4></div>
					<div class="col-sm-1"><h5>:</h5></div>
					<div class="col-sm-5"><h4 id="total_today_orders" style="float:right"><i class="fa fa-spinner" aria-hidden="true"></i></h4></div>
				</div>
			</div>
			<div class="col-sm-6 well well-sm" style="padding-left:5%;padding-right:5%">
				<div class="row"> <!-- all order history -->
					<center><h5>All Order History</h5></center>
				</div>
				<div class="row">
					<div class="col-sm-6"><h5>Total New Order</h5></div>
					<div class="col-sm-1"><h5>:</h5></div>
					<div class="col-sm-5"><h4 id="total_new_order" style="float:right"><i class="fa fa-spinner" aria-hidden="true"></i></h4></div>
				</div>
				<div class="row">
					<div class="col-sm-6"><h5>Total In Process Order</h5></div>
					<div class="col-sm-1"><h5>:</h5></div>
					<div class="col-sm-5"><h4 id="total_process_order" style="float:right"><i class="fa fa-spinner" aria-hidden="true"></i></h4></div>
				</div>
				<div class="row">
					<div class="col-sm-6"><h5>Total Dispatched Orders</h5></div>
					<div class="col-sm-1"><h5>:</h5></div>
					<div class="col-sm-5"><h4 id="total_dispatch_order" style="float:right"><i class="fa fa-spinner" aria-hidden="true"></i></h4></div>
				</div>
				<div class="row">
					<div class="col-sm-6"><h5>Total Delivered Orders</h5></div>
					<div class="col-sm-1"><h5>:</h5></div>
					<div class="col-sm-5"><h4 id="total_delivered_order" style="float:right"><i class="fa fa-spinner" aria-hidden="true"></i></h4></div>
				</div>
				<div class="row">
					<div class="col-sm-6"><h5>Total Cancelled Orders</h5></div>
					<div class="col-sm-1"><h5>:</h5></div>
					<div class="col-sm-5"><h4 id="total_cancel_order" style="float:right"><i class="fa fa-spinner" aria-hidden="true"></i></h4></div>
				</div>

				<div class="row">
					<div class="col-sm-6"><h4>Total Orders</h4></div>
					<div class="col-sm-1"><h5>:</h5></div>
					<div class="col-sm-5"><h4 id="total_orders" style="float:right"><i class="fa fa-spinner" aria-hidden="true"></i></h4></div>
				</div>
			</div>
		</div>
		
		<div class="divide30"></div>
		
		<div class="row"><!-- for chart-->
			<div class="col-md-12">
				<div id="chartContainer" ></div>
			</div>
		</div>
		<div class="divide80"></div>
		<div class="divide80"></div>
		<div class="divide80"></div>
		<div class="divide80"></div>
		<div class="divide80"></div>
		<div class="divide80"></div>
  </div>
</div>
   </section>
</div>
<?php require_once ('theme/footer.php');?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/canvasjs.min.js"></script>
<script>

$.post("../adminapi/getAnalytics.php",
		{
			// action:"dashboard"
		},
		function(data)
		{
			// console.log(data);
			var arr=JSON.parse(data);
			document.getElementById("total_admin").innerHTML = 0;
			
			document.getElementById("total_verified_user").innerHTML = 0;
			document.getElementById("total_unverified_user").innerHTML =0;
			document.getElementById("total_blocked_user").innerHTML = 0;
			document.getElementById("total_today_new_order").innerHTML = 0;
			document.getElementById("total_today_in_process_order").innerHTML = 0;
			document.getElementById("total_today_in_dispatch_order").innerHTML = 0;
			document.getElementById("total_today_delivered_order").innerHTML = 0;
			document.getElementById("total_today_cancel_order").innerHTML = 0;
			document.getElementById("total_new_order").innerHTML = 0;
			document.getElementById("total_process_order").innerHTML = 0;
			document.getElementById("total_dispatch_order").innerHTML = 0;
			document.getElementById("total_delivered_order").innerHTML = 0;
			document.getElementById("total_cancel_order").innerHTML = 0;



			
			if(arr.hasOwnProperty("admins"))
				document.getElementById("total_admin").innerHTML = arr.admins;

			if(arr.hasOwnProperty("verified_users"))
				document.getElementById("total_verified_user").innerHTML = arr.verified_users;

			if(arr.hasOwnProperty("unverified_users"))
				document.getElementById("total_unverified_user").innerHTML = arr.unverified_users;

			if(arr.hasOwnProperty("blocked_users"))
				document.getElementById("total_blocked_user").innerHTML = arr.blocked_users;
			
			if(arr.hasOwnProperty("today_new_order"))
				document.getElementById("total_today_new_order").innerHTML = arr.today_new_order;

			if(arr.hasOwnProperty("today_processed_order"))
				document.getElementById("total_today_in_process_order").innerHTML = arr.today_processed_order;

			if(arr.hasOwnProperty("today_dispatched_order"))
				document.getElementById("total_today_in_dispatch_order").innerHTML = arr.today_dispatched_order;

			if(arr.hasOwnProperty("today_delivered_order"))
				document.getElementById("total_today_delivered_order").innerHTML = arr.today_delivered_order;

			if(arr.hasOwnProperty("today_cancelled_order"))
				document.getElementById("total_today_cancel_order").innerHTML = arr.today_cancelled_order;


			if(arr.hasOwnProperty("total_new_order"))
				document.getElementById("total_new_order").innerHTML = arr.total_new_order;

			if(arr.hasOwnProperty("total_processed_order"))
				document.getElementById("total_process_order").innerHTML = arr.total_processed_order;

			if(arr.hasOwnProperty("total_dispatched_order"))
				document.getElementById("total_dispatch_order").innerHTML = arr.total_dispatched_order;

			if(arr.hasOwnProperty("total_delivered_order"))
				document.getElementById("total_delivered_order").innerHTML = arr.total_delivered_order;

			if(arr.hasOwnProperty("total_cancelled_order"))
				document.getElementById("total_cancel_order").innerHTML = arr.total_cancelled_order;

			document.getElementById("total_orders").innerHTML=arr.total_orders;
			document.getElementById("total_today_orders").innerHTML=arr.total_today_orders;


			var datapoints=[];

			for(i=0;i<arr.statistics.length;i++)
			{
				datapoints.push({ label: arr.statistics[i]["order_date"], y: parseInt(arr.statistics[i]["count"]) });
			}

			var chart = new CanvasJS.Chart("chartContainer", {
				backgroundColor: "#F5F5F5",
				title: {
					text: "Last 10 day's orders"
				},
				data: 
				[{
					type: "spline", 
					color : "#3C8DBC",
					dataPoints: datapoints
				}]
			});
			chart.render();
			
		});

</script>