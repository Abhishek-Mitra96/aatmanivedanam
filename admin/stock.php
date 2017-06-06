<?php 

require_once ('theme/header_1.php'); 
require_once ('theme/header_2.php'); 
require_once ('theme/sidebar.php');
// include_once '../include/config.php';
// include_once '../include/function.php';
?>
</section>
<style type="text/css">
#upd_btn {
	display: inline-block;
}
#upload8 {
	display: inline-block;
}
.autocomplete {
	width: 200px;
	position: absolute;
	z-index: 1;
	background-color: #fff;
	border: 1px solid #ddd;
}
ul.list {
	list-style: none;
}
ul.list li {
	border-bottom: 1px solid #ddd;
}
ul.list li:hover {
	background-color: #3C8DBC;
	color: #fff;
	cursor: pointer;
}
</style>
<div class="content-wrapper">
  <section class="content-header">
  <h1>
  Stock Purchase
  </section>
  <section class="content">
    <div class="box box-primary" id="box-widget">
      <div class="box-header">
        <div class="divide20"></div>
      </div>
      <!-- /.box-header -->
      
      <div class="divide10"></div>
      <div class="box-body table-responsive no-padding">
        <form action="" method="post">
          <table class="table table-responsive" id="myTable">
            <tr>
              <th>Product</th>
              <th>Size</th>
              <th>Color</th>
              <th>Quantity</th>
            </tr>
            <tr id='firsttr'>
              <td id="firsttd"><input type="text" name="pid[]" class="search_product" id="search_product1" lid="1" autocomplete="off">
                <br>
                <div id="pr1" class="autocomplete"></div></td>
              <td id="secondtd">
              	<select name="size[]" class="search_size" id="search_size1"></select>
              </td>
              <td id="thirdtd">
              	<select name="color[]" class="search_color" id="search_color1"></select>
              </td>
              <td id="fourthtd"><input type="number" name="quantity[]" id="quantity1" value="1" autocomplete="off">
              		<input type="hidden" id="hiddenproductid1" name="hidden[]" value="">
              </td>
              
            </tr>
          </table>
          <input type="button" name="submit" id="submit" class="btn btn-success" value="Submit">
          <button id="add" type="button" class="add btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add New Row</button>
        </form>
        <div id="content"> </div>
      </div>
      <div class="box-footer"> </div>
    </div>
  </section>
</div>
<?php require_once ('theme/footer.php');?>
<script>
var count=1;
var i = 1;

$(document).ready(function()
{
	$('body').on("keyup",'.search_product',function(e) 
	{
		var search=$(this).val();
		var id=$(this).attr("lid");
		// toast(id);
		if(search.length!=0)
		search_product(search,id);
		else
		$(".autocomplete").html("");
	});
	
	$('#submit').click(function(e) {
		var p = [];
		var c = [];
		var s = [];
		var q = [];
  		var n = 1;
 		
  		$.each($('input[name="hidden[]"]'), function(e){
    		p[e] = $('#hiddenproductid'+n+'').val();
   			n++;
   			// alert("Product id "+p[e]);
		});
		
		var n = 1;
		$.each($('.search_size'), function(e){
    		s[e] = $('#search_size'+n+'').val();
   			n++;
   			// alert("Size id "+s[e]);
		});

		var n = 1;
		$.each($('.search_color'), function(e){
    		c[e] = $('#search_color'+n+'').val();
   			n++;
   			// alert("Color id "+c[e]);
		});

  		var n = 1;
  		$.each($('input[name="quantity[]"]'), function(e){
    		q[e] = $('#quantity'+n+'').val();
   			n++;
   			// alert("Quantity "+q[e]);
		});
  		
	var x2 = $('#search_product1').val();
  	var y2 = $('#search_size1').val();
 	var z2 = $('#search_color1').val();
  	var q2 = $('#quantity1').val();
	if(x2 == '')
	{alert('Please choose a product to proceed'); return false;}
	if(y2 == '')
	{alert('Please choose a size to proceed'); return false;}
	if(z2 == '')
	{alert('Please choose a color to proceed'); return false;}
	if(q2 == '')
	{alert('Please choose atleast one quantity proceed'); return false;}
	
	$.ajax({
		type: 'POST',
		url: '../adminapi/product/stockupdate.php',
		data: {
			product_id:p,
			color:c,
			size:s,
			quantity:q,
			viewall:1
			},
		success: function(data) {
			if(data == 1)
			{
				toast('Successfully updated');
				location.reload();
			}			
		}
	});	
});
	
	$('.add').click(function(){

			i++;
        var tabledata = '<tr><td id="firsttd"><input type="text" name="pid[]" class="search_product" id="search_product' + i + '" lid="' + i + '" autocomplete="off"><br><div id="pr' + i + '" class="autocomplete"></div></td><td id="secondtd"><select name="size[]" class="search_size" id="search_size' + i + '"></select></td><td id="thirdtd"><select name="color[]" class="search_color" id="search_color' + i + '"></select></td><td id="fourthtd"><input type="number" name="quantity[]" id="quantity' + i + '" value="1" autocomplete="off"><input type="hidden" name="hidden[]" id="hiddenproductid'+i+'" value=""></td></tr>'

		$('<tr>' + tabledata + '</tr>').insertAfter($( "tr:last" ));

	});
	
});

function product_attribute(product_id)
{

	$("#hiddenproductid"+i+"").val(product_id);
	
	$.ajax({
		type: 'POST',
		url: '../commonapi/product/details.php',
		data: {
			product_id:product_id,
			viewall:1
			},
		success: function(fetchdata) {		
			console.log(fetchdata);
			var data = jQuery.parseJSON(fetchdata);
			if('size' in data)
			{	
				var html = '';
				$(data.size).each(function(index, element) {
                    if(html == '')
					{
						html = '<option id="'+ element.size_id +'" value="'+element.size_id+'">'+ element.size +'</option>'; 
					}
					else
					{
						html = html + '<br/>' + '<option id="'+ element.size_id +'" value="'+element.size_id+'">'+ element.size +'</option>';	
					}
			    });
			    $("#search_size"+ i +"").html(html);
			}
			else
			{
				html = '<option id="0">0</option>';
				$("#search_size"+ i +"").html(html);
			}
			if('color' in data)
			{	
				var html = '';
				$(data.color).each(function(index, element) {
                    if(html == '')
					{
						html = '<option id="'+ element.color_id +'" value="'+element.color_id+'">'+ element.color +'</option>'; 
					}
					else
					{
						html = html + '<br/>' + '<option id="'+ element.color_id +'" value="'+element.color_id+'">'+ element.color +'</option>';	
					}
			    });
				$("#search_color"+ i +"").html(html);
			}
			else
			{
				html = '<option id="0">0</option>'; 	
				$("#search_color"+ i +"").html(html);
							}
		}
	});
}



function search_product(searchkey,id)
{       

	$.ajax({
		type: 'POST',
		url: '../commonapi/product/list.php',
		data: {
			search:searchkey,
			limit:5,
			viewall:1
			},
		success: function(fetchdata) {		
			//alert(fetchdata);
			print_data(fetchdata,id);
		}
	});
}

function print_data(fetchdata,id)
{
	var arr=JSON.parse(fetchdata);	
	if(arr.status=="success")
	{
		var x;
		var out='<ul class="list">';
		for(x=0;x<arr.products.length;x++)
		{
			var product_name=arr.products[x].product_name;
			out+="<li class='product' onClick='product_attribute("+arr.products[x].id+")' id='"+arr.products[x].id+"' val='"+product_name+"'>"+product_name+"</li>";
		}
		out+="</ul>";
		document.getElementById("pr"+id).innerHTML=out;
	}
	else
	{
		document.getElementById("pr1").innerHTML="";
	}


	$("body").on("click",".product",function()
	{
		var val=$(this).attr("val");
		$("#search_product"+i+"").val(val);
		$(this).parent().remove();
	});


}
</script>