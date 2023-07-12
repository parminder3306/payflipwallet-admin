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
<title>Send Notifications</title>
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
<a href="/admin/SendNotifications">
<div class="menu-li-active">
<span class="icon fa fa-arrows-v"></span>
<div class="menu-left-text">SEND NOTIFICATIONS</div>
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
    <button type="button" id="allbtn" data-toggle="modal" data-target="#all" class="mybtn_small">All Notifications</button>
   </div>
   <div class="table-responsive">
    <table id="sendnotifications" class="table table-bordered table-striped">
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
var base_url ="auth/sendnotifications.php";

 $('#allbtn').click(function(){
  $('#all_form')[0].reset();
 }); 
 
 var productTable = $('#sendnotifications').bootgrid({
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
    return "<button type=\"button\" class=\"btn btn-success btn-xs singleform\"  data-row-id=\""+row.accesskey+"\">SEND NOTIFICATIONS</button>";
   }
  }
 });
 
   $(document).on('submit', '#all_form', function(event){
  event.preventDefault();
  var title = $('#title').val();
  var message = $('#message').val();
  var activity = $('#activity').val();
  if(title != '' && message != '' && activity != '')
  {
   $.ajax({
    url:base_url+"?source=all",
    method:"POST",
    data:$(this).serialize(),
    success:function(data)
    {
     alert(data);
     $('#all').modal('hide');
     $('#sendnotifications').bootgrid('reload');
    
    }
   });
  }
  else
  {
   alert("All Fields are Required");
  }
 });
 
   $(document).on('submit', '#single_form', function(event){
  event.preventDefault();
  var title = $('#stitle').val();
  var message = $('#smessage').val();
  var activity = $('#sactivity').val();
  if(title != '' && message != '' && activity != '')
  {
   $.ajax({
    url:base_url+"?source=single",
    method:"POST",
    data:$(this).serialize(),
    success:function(data){
     alert(data);
     $('#single').modal('hide');
     $('#sendnotifications').bootgrid('reload');
    
    }
   });
  }
  else
  {
   alert("All Fields are Required");
  }
 });
 
 
  $(document).on("loaded.rs.jquery.bootgrid", function(){
    productTable.find(".singleform").on("click", function(event){
	$('#single_form')[0].reset();
     $('#single').modal('show');
	$('#accesskey').val($(this).data("row-id"));	 
  });
 }); 
});
</script>
<div id="all" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="all_form">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Notification Management: All</h4>
    </div>
    <div class="modal-body">
     <label>Title</label>
     <input type="text" name="title" id="title" />
	 <label>Message</label>
     <input type="text" name="message" id="message" />
	  <label>Banner Url</label>
     <input type="text" name="banner" id="banner" />
	 <label>Activity</label>
	<select name="activity" id="activity">
	<option value="">Select Activity</option>
	<option value="MainActivity">MainActivity</option>
	<option value="Offers">Offers</option>
	<option value="Rewards">Rewards</option>
	<option value="Recharge">Recharge</option>
	<option value="DTH">DTH</option>
	<option value="Datacard">Datacard</option>
	<option value="ReferEarn">ReferEarn</option>
	<option value="Electricity">Electricity</option>
	<option value="Landline">Landline</option>
	<option value="Voucher">Voucher</option>
	<option value="RequestPay">RequestPay</option>
	</select>
    </div>
    <div class="modal-footer">
     <input type="submit" class="mybtn" value="SEND NOW" />
    </div>
   </div>
  </form>
 </div>
</div>

<div id="single" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="single_form">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Notification Management: Single</h4>
    </div>
  <div class="modal-body">
     <label>Title</label>
     <input type="text" name="title" id="stitle" />
	 <label>Message</label>
     <input type="text" name="message" id="smessage" />
	  <label>Banner Url</label>
     <input type="text" name="banner" id="banner" />
	  <label>Activity</label>
	<select name="activity" id="sactivity">
	 <option value="">Select Activity</option>
	<option value="MainActivity">MainActivity</option>
	<option value="Offers">Offers</option>
	<option value="Rewards">Rewards</option>
	<option value="Recharge">Recharge</option>
	<option value="DTH">DTH</option>
	<option value="Datacard">Datacard</option>
	<option value="ReferEarn">ReferEarn</option>
	<option value="Electricity">Electricity</option>
	<option value="Landline">Landline</option>
	<option value="Voucher">Voucher</option>
	<option value="RequestPay">RequestPay</option>
	</select>
	<input type="hidden" name="accesskey" id="accesskey" />
    </div>
    <div class="modal-footer">
     <input type="submit" class="mybtn" value="SEND NOW" />
    </div>
   </div>
  </form>
 </div>
</div>

</body>
</html>