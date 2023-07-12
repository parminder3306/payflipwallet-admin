<?php
require_once('auth/session.php');
require_once('auth/codes.php');
?>
<!DOCTYPE html>
<html lang='en-US'>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width = device-width">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="robots" content="index, follow">
<title>Coupons</title>
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
<div class="menu-li">
<span class="icon fa fa-shopping-cart"></span>
<div class="menu-left-text">ORDERS</div>
</div></a>
<a href="/admin/Rewards">
<div class="menu-li">
<span class="icon fa fa-trophy"></span>
<div class="menu-left-text">REWARDS</div>
</div></a>
<a href="/admin/Coupons">
<div class="menu-li-active">
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
   <div align="right">
    <button type="button" id="add_button" data-toggle="modal" data-target="#addmodel" class="mybtn_small">ADD</button>
   </div>
   <div class="table-responsive">
    <table id="coupons" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th data-column-id="id" data-type="numeric">ID</th>
       <th data-column-id="promocode">PROMOCODE</th>
       <th data-column-id="percent">DISCOUNT(%)</th>
       <th data-column-id="apply_min">APPLY MIN</th>
       <th data-column-id="apply_max">APPLY MAX</th>
	   <th data-column-id="apply_uses">APPLY USES</th>
	   <th data-column-id="redeem">REDEEM</th>
	   <th data-column-id="users">USERS</th>
	   <th data-column-id="apply">APPLY</th>
	   <th data-column-id="validity">VALIDITY</th>
	   <th data-column-id="status">STATUS</th>
	   <th data-column-id="openable">OPEN</th>
       <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
      </tr>
     </thead>
    </table>
   </div>
 </body>
</html>
<script type="text/javascript" language="javascript" >
$(document).ready(function(){
var base_url ="auth/coupons.php";

 $('#add_button').click(function(){
  $('#add_form')[0].reset();
 }); 
 
 var productTable = $('#coupons').bootgrid({
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
    return "<button type=\"button\" class=\"btn btn-info btn-xs edit\" data-row-id=\""+row.id+"\">EDIT</button>" + 
    "&nbsp; <button type=\"button\" class=\"btn btn-danger btn-xs delete\" data-row-id=\""+row.id+"\">DELETE</button>";
   }
  }
 });
 
   $(document).on('submit', '#add_form', function(event){
  event.preventDefault();
   $.ajax({
    url:base_url+"?source=add",
    method:"POST",
    data:$("#add_form").serialize(),
    success:function(data) {
    if(data == "success"){
     $('#addmodel').modal('hide');
     $('#coupons').bootgrid('reload');
    }else{
		alert(data);
	}
    }
   });
 });
 
 $(document).on('submit', '#edit_form', function(event){
	event.preventDefault();
   $.ajax({
    url:base_url+"?source=edit",
    method:"POST",
    data:$("#edit_form").serialize(),
    success:function(data)
    {
	 if(data == "success"){
     $('#editmodel').modal('hide');
     $('#coupons').bootgrid('reload');
    }else{
		alert(data);
	}
    }
   });
 });
 
  $(document).on("loaded.rs.jquery.bootgrid", function(){
	 productTable.find(".edit").on("click", function(event){
    $.ajax({
    url:base_url+"?source=details",
    method:"POST",
    data:{id:$(this).data("row-id")},
    dataType:"json",
    success:function(data)
    {
     $('#editmodel').modal('show');
     $('#id').val(data.id);
     $('#promocode').val(data.promocode);
     $('#percent').val(data.percent);
     $('#apply_min').val(data.apply_min);
     $('#apply_max').val(data.apply_max);
     $('#apply_uses').val(data.apply_uses);
     $('#users').val(data.users);
     $('#apply').val(data.apply);
     $('#openable').val(data.openable);
     $('#validity').val(data.validity);
    }
   });
  });
  productTable.find(".delete").on("click", function(event) {
   if(confirm("Are you sure you want to delete this?"))
   {
    $.ajax({
     url:base_url+"?source=delete",
     method:"POST",
     data:{id:$(this).data("row-id")},
     success:function(data)
     {
      alert(data);
      $('#coupons').bootgrid('reload');
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
<div id="addmodel" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="add_form">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">New Promocode</h4>
    </div>
    <div class="modal-body">
<label>Promocode:</label>
<input type="text" name="promocode" />
<label>Discount (%) :</label>
<input type="text" name="percent">
<label>Min Amount (Less than):</label>
<input type="text" name="apply_min" />
<label>Max Amount (More than):</label>
<input type="text" name="apply_max" />
<label>Total Redeem (Total Redeem):</label>
<input type="text" name="apply_uses" />
<label>Total Users:</label>
<input type="text" name="users" />
<label>Apply On :</label>
<select name="apply">
<option value="">Select Option</option>
<option value="AddMoney">AddMoney</option>
<option value="SendMoney">SendMoney</option>
<option value="Recharge">Recharge</option>
<option value="DTH">DTH</option>
<option value="Electricity">Electricity</option>
<option value="Landline">Landline</option>
<option value="GooglePlay">GooglePlay</option>
</select>
<label>Openable :</label>
<select name="openable">
<option value="">Select Option</option>
<option value="Yes">Yes</option>
<option value="No">No</option>
</select>
<label>Validity (Year-Month-Date):</label>
<input type="text" name="validity" value="<?php echo $dateverify;?>">
    </div>
    <div class="modal-footer">
     <input type="submit" class="mybtn" value="ADD PROMOCODE" />
    </div>
   </div>
  </form>
 </div>
</div>

<div id="editmodel" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="edit_form">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Change Details</h4>
    </div>
    <div class="modal-body">
<label>Promocode:</label>
<input type="text" name="promocode" id="promocode"/>
<label>Discount (%) :</label>
<input type="text" name="percent" id="percent"/>
<label>Min Amount (Less than):</label>
<input type="text" name="apply_min" id="apply_min"/>
<label>Max Amount (More than):</label>
<input type="text" name="apply_max" id="apply_max"/>
<label>Total Redeem (Total Redeem):</label>
<input type="text" name="apply_uses" id="apply_uses"/>
<label>Total Users:</label>
<input type="text" name="users" id="users"/>
<label>Apply On :</label>
<select name="apply" id="apply">
<option value="">Select Option</option>
<option value="AddMoney">AddMoney</option>
<option value="SendMoney">SendMoney</option>
<option value="Recharge">Recharge</option>
<option value="DTH">DTH</option>
<option value="Electricity">Electricity</option>
<option value="Landline">Landline</option>
<option value="GooglePlay">GooglePlay</option>
</select>
<label>Openable :</label>
<select name="openable" id="openable">
<option value="">Select Option</option>
<option value="Yes">Yes</option>
<option value="No">No</option>
</select>
<label>Validity (Year-Month-Date):</label>
<input type="text" name="validity" id="validity">
<input type="hidden" name="id" id="id">
    </div>
    <div class="modal-footer">
     <input type="submit" class="mybtn" value="UPDATE" />
    </div>
   </div>
  </form>
 </div>
</div>
