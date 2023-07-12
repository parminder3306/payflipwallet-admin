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
<title>All Users</title>
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
<div class="menu-li-active">
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
   <div align="right">
    <button type="button" id="add_button" data-toggle="modal" data-target="#addmodel" class="mybtn_small">New Account</button>
   </div>
   <div class="table-responsive">
    <table id="users" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th data-column-id="uid" data-type="numeric">ID</th>
       <th data-column-id="type">TYPE</th>
       <th data-column-id="name">NAME</th>
       <th data-column-id="mobile">MOBILE</th>
       <th data-column-id="email">EMAIL ID</th>
	   <th data-column-id="wallet">BALANCE</th>
	   <th data-column-id="spendmoney">SPENDMONEY</th>
	   <th data-column-id="access">STATUS</th>
	    <th data-column-id="date">DATE</th>
       <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
      </tr>
     </thead>
    </table>
   </div>
 </body>
</html>
<script type="text/javascript" language="javascript" >
$(document).ready(function(){
var base_url ="auth/users.php";

 $('#add_button').click(function(){
  $('#add_form')[0].reset();
 }); 
 
 var productTable = $('#users').bootgrid({
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
    return "<button type=\"button\" class=\"btn btn-success btn-xs addmoney\" id=\"add_button\" data-row-id=\""+row.uid+"\">ADD</button>" + 
    "&nbsp; <button type=\"button\" class=\"btn btn-warning btn-xs debit\" data-row-id=\""+row.uid+"\">DEBIT</button>" + 
    "&nbsp; <button type=\"button\" class=\"btn btn-info btn-xs edit\" data-row-id=\""+row.uid+"\">EDIT</button>" + 
    "&nbsp; <button type=\"button\" class=\"btn btn-danger btn-xs delete\" data-row-id=\""+row.uid+"\">DELETE</button>";
   }
  }
 });
 
  $(document).on('submit', '#add_form', function(event){
  event.preventDefault();
  var name = $('#name').val();
  var mobile = $('#mobile').val();
  var email = $('#email').val();
  var password = $('#password').val();
  var form_data = $(this).serialize();
  if(name != '' && mobile != '' && email != '')
  {
   $.ajax({
    url:base_url+"?source=add",
    method:"POST",
    data:form_data,
    success:function(data)
    {
    if(data == "success"){
     $('#addmodel').modal('hide');
     $('#users').bootgrid('reload');
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
 
 $(document).on('submit', '#addmoney_form', function(event){
  event.preventDefault();
  var amount = $('#amount').val();
  var form_data = $(this).serialize();
  if(amount != '')
  {
   $.ajax({
    url:base_url+"?source=addmoney",
    method:"POST",
    data:form_data,
    success:function(data){
	  alert(data);
     $('#addmoneymodel').modal('hide');
     $('#users').bootgrid('reload');
    }
   });
  }
  else
  {
   alert("All Fields are Required");
  }
 });
 
  $(document).on('submit', '#debit_form', function(event){
  event.preventDefault();
  var damount = $('#damount').val();
  var form_data = $(this).serialize();
  if(damount != '')
  {
   $.ajax({
    url:base_url+"?source=debit",
    method:"POST",
    data:form_data,
    success:function(data){
	  alert(data);
     $('#debitmodel').modal('hide');
     $('#users').bootgrid('reload');
    }
   });
  }
  else
  {
   alert("All Fields are Required");
  }
 });
 
   $(document).on('submit', '#edit_form', function(event){
  event.preventDefault();
  var vname = $('#vname').val();
  var vmobile = $('#vmobile').val();
  var vemail = $('#vemail').val();
  var vaccess = $('#vaccess').val();
  var form_data = $(this).serialize();
  if(vname != '' && vmobile != '' && vemail != '')
  {
   $.ajax({
    url:base_url+"?source=edit",
    method:"POST",
    data:form_data,
    success:function(data)
    {
	 if(data == "success"){
     $('#editmodel').modal('hide');
     $('#users').bootgrid('reload');
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
  productTable.find(".addmoney").on("click", function(event){
    $.ajax({
    url:base_url+"?source=details",
    method:"POST",
    data:{uid:$(this).data("row-id")},
    dataType:"json",
    success:function(data)
    {
     $('#addmoneymodel').modal('show');
     $('#uid').val(data.uid);
     $('#umobile').val(data.mobile);
    }
   });
  });
  
     productTable.find(".debit").on("click", function(event){
    $.ajax({
    url:base_url+"?source=details",
    method:"POST",
    data:{uid:$(this).data("row-id")},
    dataType:"json",
    success:function(data)
    {
     $('#debitmodel').modal('show');
     $('#did').val(data.uid);
     $('#dmobile').val(data.mobile);
    }
   });
  });
  
	productTable.find(".edit").on("click", function(event){
    $.ajax({
    url:base_url+"?source=details",
    method:"POST",
    data:{uid:$(this).data("row-id")},
    dataType:"json",
    success:function(data)
    {
     $('#editmodel').modal('show');
     $('#vname').val(data.name);
     $('#vmobile').val(data.mobile);
     $('#vemail').val(data.email);
     $('#vaccess').val(data.access);
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
     data:{uid:$(this).data("row-id")},
     success:function(data)
     {
      alert(data);
      $('#users').bootgrid('reload');
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
     <h4 class="modal-title">Add Account</h4>
    </div>
    <div class="modal-body">
     <label>Name</label>
     <input type="text" name="name" id="name" />
	 <label>Mobile No.</label>
     <input type="text" name="mobile" id="mobile" />
	 <label>Email ID</label>
     <input type="text" name="email" id="email" />
	 <label>Password</label>
     <input type="text" name="password" id="password" />
    </div>
    <div class="modal-footer">
     <input type="submit" class="mybtn" value="ADD ACCOUNT" />
    </div>
   </div>
  </form>
 </div>
</div>

<div id="addmoneymodel" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="addmoney_form">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">AddMoney</h4>
    </div>
    <div class="modal-body">
     <label>Amount</label>
     <input type="text" id="amount" name="amount" />
     <input type="hidden" id="umobile" name="mobile" />
     <input type="hidden" id="uid" name="uid" />
    </div>
    <div class="modal-footer">
     <input type="submit" class="mybtn" value="ADD MONEY" />
    </div>
   </div>
  </form>
 </div>
</div>

<div id="debitmodel" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="debit_form">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Debit Money</h4>
    </div>
    <div class="modal-body">
     <label>Amount</label>
     <input type="text" id="damount" name="amount" />
     <input type="hidden" id="dmobile" name="mobile" />
     <input type="hidden" id="did" name="uid" />
    </div>
    <div class="modal-footer">
     <input type="submit" class="mybtn" value="ADD MONEY" />
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
     <h4 class="modal-title">Edit Account</h4>
    </div>
    <div class="modal-body">
     <label>Name</label>
     <input type="text" id="vname" name="name" />
	 <label>Mobile No.</label>
     <input type="text" id="vmobile" name="mobile" />
	 <label>Email ID</label>
     <input type="text" id="vemail" name="email" />
	 <label>Access</label>
    <select name="access" id="vaccess">
	<option value="Active">Active</option>
	<option value="Block">Block</option>
	</select>
    </div>
    <div class="modal-footer">
     <input type="submit" class="mybtn" value="CHANGE" />
    </div>
   </div>
  </form>
 </div>
</div>

</body>
</html>