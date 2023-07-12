<?php
require_once('auth/session.php');
?>
<!DOCTYPE html>
<html lang='en-US'>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width = device-width">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="robots" content="index, follow">
<title>Orders</title>
<link rel="stylesheet" href="/admin/css/style.css" type="text/css" >
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/admin/css/bootstrap.css"/>
<link rel="stylesheet" href="/admin/css/jquery.bootgrid.css" />
<script src="/admin/ajax/jquery.js"></script>
<script src="/admin/ajax/bootstrap.min.js"></script>
<script src="/admin/ajax/jquery.bootgrid.js"></script> 
</head>
<body>
<div class="header">
<div class="logo">PAYFLIPWALLET<span style="font-size:10px;">ADMIN</span></div>
<div class="user">
<a href="javascript:void(0);"><?php echo $ceo;?></a>
<div class="user-content">
<a href="/admin/changepin">Change PIN</a>
<a href="/admin/auth/logout">Log Out</a>
</div>
</div>																			
</div>		
<div class="menu-left">
<a href="/admin">
<div class="menu-li">
<span class="icon fa fa-dashboard"></span>
<div class="menu-left-text">DASHBOARD</div>
</div></a>
<a href="/admin/Users">
<div class="menu-li">
<span class="icon fa fa-meh-o"></span>
<div class="menu-left-text">USERS</div>
</div></a>
<a href="/admin/Orders">
<div class="menu-li-active">
<span class="icon fa fa-shopping-cart"></span>
<div class="menu-left-text">ORDERS</div>
</div></a>
<a href="/admin/Rewards">
<div class="menu-li">
<span class="icon fa fa-trophy"></span>
<div class="menu-left-text">REWARDS</div>
</div></a>
<a href="/admin/Coupons">
<div class="menu-li">
<span class="icon fa fa-tag"></span>
<div class="menu-left-text">COUPONS</div>
</div></a>
<a href="/admin/Offers">
<div class="menu-li">
<span class="icon fa fa-gift"></span>
<div class="menu-left-text">OFFERS</div>
</div></a>
<a href="/admin/Sendemail.php">
<div class="menu-li">
<span class="icon fa fa-envelope"></span>
<div class="menu-left-text">EMAIL</div>
</div></a>
<a href="/admin/Notifications">
<div class="menu-li">
<span class="icon fa fa-commenting"></span>
<div class="menu-left-text">NOTIFICATIONS</div>
</div></a>
<a href="/admin/Bank-Transfer">
<div class="menu-li">
<span class="icon fa fa-bank"></span>
<div class="menu-left-text">BANK TRANSFER</div>
</div></a>
<a href="/admin/Referprogram">
<div class="menu-li">
<span class="icon fa fa-bullhorn"></span>
<div class="menu-left-text">REFER PROGRAM</div>
</div></a>
<a href="/admin/Autopay">
<div class="menu-li">
<span class="icon fa fa-calendar-check-o"></span>
<div class="menu-left-text">AUTO PAY</div>
</div></a>
<a href="/admin/Setup">
<div class="menu-li">
<span class="icon fa fa-wrench"></span>
<div class="menu-left-text">SETUP</div>
</div></a>
<div class="menu-left-footer">PAYFLIPWALLET ADMIN V1.2</div>
</div>
<div class="container">
   <div class="table-responsive">
    <table id="orders" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th data-column-id="id" data-type="numeric">ID</th>
       <th data-column-id="orderid">ORDER ID</th>
	   <th data-column-id="type">TYPE</th>  
	   <th data-column-id="operator">OPERATOR</th>	 
	   <th data-column-id="number">NUMBER</th>
	   <th data-column-id="acnumber">ACNUMBER</th>	   
	   <th data-column-id="amount">AMOUNT</th>	   
	   <th data-column-id="cashback">CASHBACK</th> 
	   <th data-column-id="time">TIME</th>
	   <th data-column-id="date">DATE</th>
	   <th data-column-id="status">STATUS</th>
       <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
      </tr>
     </thead>
    </table>
   </div>
 </body>
</html>
<script type="text/javascript" language="javascript" >
$(document).ready(function(){
var base_url ="auth/orders.php";
 
 var productTable = $('#orders').bootgrid({
  ajax: true,
  rowSelect: true,
  post: function()
  {
   return{
    id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
   };
  },
  url:base_url+"?source=alldata",
  formatters: {
   "commands": function(column, row)
   {
	if(row.status == "Success" || row.status == "Refund"){ 
    return "<button type=\"button\" disabled class=\"btn btn-success btn-xs refund\" id=\"add_button\" data-row-id=\""+row.id+"\">REFUND</button>" + 
    "&nbsp; <button type=\"button\" disabled class=\"btn btn-info btn-xs edit\" data-row-id=\""+row.id+"\">EDIT</button>" + 
    "&nbsp; <button type=\"button\" class=\"btn btn-danger btn-xs delete\" data-row-id=\""+row.id+"\">DELETE</button>";
   
   }else{
	   return "<button type=\"button\" class=\"btn btn-success btn-xs refund\" id=\"add_button\" data-row-id=\""+row.id+"\">REFUND</button>" + 
    "&nbsp; <button type=\"button\" class=\"btn btn-info btn-xs edit\" data-row-id=\""+row.id+"\">EDIT</button>" + 
    "&nbsp; <button type=\"button\" class=\"btn btn-danger btn-xs delete\" data-row-id=\""+row.id+"\">DELETE</button>";   
   }
   }
  }
 });
 
  $(document).on('submit', '#edit_form', function(event){
  event.preventDefault();
  var status = $('#status').val();
  var form_data = $(this).serialize();
  if(status != '')
  {
   $.ajax({
    url:base_url+"?source=edit",
    method:"POST",
    data:form_data,
    success:function(data)
    {
	 if(data == "success"){
     $('#editmodel').modal('hide');
     $('#orders').bootgrid('reload');
    }else{
		alert(data);
	}
    }
   });
  }
  else
  {
   alert("All Fields are Required");
  }
 });

 
 
  $(document).on("loaded.rs.jquery.bootgrid", function(){
	productTable.find(".edit").on("click", function(event){
	$('#edit_form')[0].reset();	
    $.ajax({
    url:base_url+"?source=details",
    method:"POST",
    data:{id:$(this).data("row-id")},
    dataType:"json",
    success:function(data)
    {
     $('#editmodel').modal('show');
     $('#oid').val(data.id);
    }
   });
  });
  
  	productTable.find(".refund").on("click", function(event){
    $.ajax({
    url:base_url+"?source=details",
    method:"POST",
    data:{id:$(this).data("row-id")},
    dataType:"json",
    success:function(data)
    { 
	if(confirm("Are you sure you want to Refund this?"))
   {
    $.ajax({
     url:base_url+"?source=refund",
     method:"POST",
	 dataType: "text", 
     data:{"uid":data.uid,"orderid":data.orderid,"number":data.number,"amount":data.amount},
     success:function(data)
     {
      alert(data);
      $('#orders').bootgrid('reload');
     }
    })
	}
   else{
    return false;
   }
    }
   });
  });

  productTable.find(".delete").on("click", function(event)
  {
   if(confirm("Are you sure you want to delete this?"))
   {
    $.ajax({
     url:base_url+"?source=delete",
     method:"POST",
     data:{id:$(this).data("row-id")},
     success:function(data)
     {
      alert(data);
      $('#orders').bootgrid('reload');
     }
    })
   }
   else{
    return false;
   }
  });
 }); 
});
</script>

<div id="editmodel" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="edit_form">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Order Status</h4>
    </div>
    <div class="modal-body">
	 <label>Status</label>
    <select name="status" id="status">
	<option value="">Select Option</option>
	<option value="Processing">Processing</option>
	<option value="Failure">Failure</option>
	<option value="Success">Success</option>
	</select>
	<input type="hidden" name="id" id="oid"/>
    </div>
    <div class="modal-footer">
     <input type="submit" class="mybtn" value="CHANGE STATUS" />
    </div>
   </div>
  </form>
 </div>
</div>

</body>
</html>