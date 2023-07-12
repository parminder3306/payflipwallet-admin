<?php
require_once('auth/session.php');
?>
<!DOCTYPE html>
<meta charset="utf-8">
<meta name="viewport" content="width = device-width">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="robots" content="index, follow">
<title>Admin Dashboard</title>
<html lang='en-US'>
<head>
<link rel="stylesheet" href="/admin/css/style.css" type="text/css" media="all">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="/admin/ajax/jquery.js"></script>
<script>
function json() {
$.getJSON("/admin/auth/json", function(response) {
$("#users").html(response.users);
$("#referral").html(response.referral);
$("#coupons").html(response.coupons);
$("#balance").html(response.balance);
$("#offers").html(response.offers);
$("#refunds").html(response.refunds);
$("#success").html(response.success);
$("#pending").html(response.pending);
$("#failure").html(response.failure);
});
}
json();
setInterval('json()',3000);
</script>
</head>
<body>
<div class="header">
<div class="logo">PAYFLIPWALLET<span style="font-size:10px;">ADMIN V2</span></div>
<div class="user"><a href="javascript:void(0);"><?php echo $ceo;?></a>
<div class="user-content">
<a href="/admin/changepin">Change PIN</a>
<a href="/admin/auth/logout">Log Out</a>
</div>
</div>																			
</div>		
<div class="menu-left">
<a href="/admin">
<div class="menu-li-active">
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
<a href="/admin/Sendemail">
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
<div class="card">
<div class="card-size">
<div class="card-image">
<span class="icon fa fa-meh-o"></span></div>
<div class="card-text">
<h3 id="users">--</h3></div>
<div class="card-text1">
<a href="javascript:void(0);">
<p class="card-font-size">Total Users</p>
</div>
</div>
</div>
<div class="card">
<div class="card-size">
<div class="card-image">
<span class="icon fa fa-bullhorn"></span></div>
<div class="card-text">
<h3 id="referral">--</h3></div>
<div class="card-text1">
<a href="javascript:void(0);">
<p class="card-font-size">Refer Earn</p>
</a>
</div>
</div>
</div>			
<div class="card">
<div class="card-size">
<div class="card-image">
<span class="icon fa fa-refresh"></span></div>
<div class="card-text">
<h3 id="refunds">--</h3></div>
<div class="card-text1">
<a href="javascript:void(0);">
<p class="card-font-size">Total Refunds</p>
</a>
</div>
</div>
</div>	
<div class="card">
<div class="card-size">
<div class="card-image">
<span class="icon fa fa-clock-o"></span></div>
<div class="card-text">
<h3 id="pending">--</h3></div>
<div class="card-text1">
<a href="javascript:void(0);">
<p class="card-font-size">Pending Orders</p>
</a>
</div>
</div>
</div>
<div class="card">
<div class="card-size">
<div class="card-image">
<span class="icon fa fa-check-circle"></span></div>
<div class="card-text">
<h3 id="success">--</h3></div>
<div class="card-text1">
<a href="javascript:void(0);">
<p class="card-font-size">Success Orders</p>
</a>
</div>
</div>
</div>
<div class="card">
<div class="card-size">
<div class="card-image">
<span class="icon fa fa-exclamation-circle"></span></div>
<div class="card-text">
<h3 id="failure">--</h3></div>
<div class="card-text1">
<a href="javascript:void(0);">
<p class="card-font-size">Failure Orders</p>
</a>
</div>
</div>
</div>
<div class="admin-card">
<div class="admin-title">Admin Panel</div>
<div class="admin-body">
<a href="javascript:void(0);">
<div class="admin-details">
<div class="admin-text">Api Balance :</div>
<div class="admin-text-right"><span id="balance">0</span></div>
</div></a>
<a href="javascript:void(0);">
<div class="admin-details">
<div class="admin-text">Active Offers :</div>
<div class="admin-text-right"><span id="offers">0</span></div>
</div></a>
</div>
</div>
</div>      	     	
</body></html>