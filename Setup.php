<?php
require_once('auth/setup.php');
$display=(isset($_GET['display']))?$sp->real_escape_string(trim($_GET['display'])):'Payumoney';
?>
<!DOCTYPE html>
<html lang='en-US'>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width = device-width">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="robots" content="index, follow">
<title>Setup</title>
<link rel="stylesheet" href="/admin/css/style.css" type="text/css" media="all">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="/admin/ajax/jquery.js"></script>
<script>
function json() {
$.getJSON("/admin/auth/json", function(response) {
$("#operators").html(response.operators);
$("#api").html(response.api);
$("#gateway").html(response.gateway);
});
}
json();
setInterval('json()',3000);
</script>
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
<a href="/admin/setup">
<div class="menu-li-active">
<span class="icon fa fa-cogs"></span>
<div class="menu-left-text">SETUP</div>
</div></a>
<a href="/admin/Setup?display=Payumoney">
<div class="menu-li<?php if($display=='Payumoney'){echo '-active';}else{echo '';};?>">
<span class="icon fa fa-arrows-v"></span>
<div class="menu-left-text">PAYUMONEY PG</div>
</div></a>
<a href="/admin/Setup?display=Pay2all">
<div class="menu-li<?php if($display=='Pay2all'){echo '-active';}else{echo '';};?>">
<span class="icon fa fa-arrows-v"></span>
<div class="menu-left-text">PAY2ALL API</div>
</div></a>
<a href="/admin/Opertators">
<div class="menu-li">
<span class="icon fa fa-arrows-v"></span>
<div class="menu-left-text">OPERATORS</div>
</div></a>
<div class="menu-left-footer">PAYFLIPWALLET ADMIN V1.2</div>
</div>
<div class="card" style="width:27%">
<div class="card-size">
<div class="card-image">
<span class="icon fa fa-plug"></span></div>
<div class="card-text">
<h3 id="api">--</h3></div>
<div class="card-text1">
<a href="javascript:void(0);">
<p class="card-font-size">Recharge API</p>
</div>
</div>
</div>
<div class="card" style="width:27%">
<div class="card-size">
<div class="card-image">
<span class="icon fa fa-plug"></span></div>
<div class="card-text">
<h3 id="gateway">--</h3></div>
<div class="card-text1">
<a href="javascript:void(0);">
<p class="card-font-size">Payment Gateway</p>
</div>
</div>
</div>
<div class="card" style="width:27%">
<div class="card-size">
<div class="card-image">
<span class="icon fa fa-plug"></span></div>
<div class="card-text">
<h3 id="operators">--</h3></div>
<div class="card-text1">
<a href="javascript:void(0);">
<p class="card-font-size">All Operators</p>
</div>
</div>
</div>
<div class="card-x" style="<?php if($display=='Payumoney'){echo 'display:block;';}else{echo 'display:none;';};?>">
<div style="text-align:center;margin-bottom:5px">PayUMoney Gateway</div>
<form method="POST" action="" autocomplete="off">
<?php if(isset($msg)){ echo $msg;}?>
<label>Merchant Key:</label>
<input type="text" name="key" value="<?php if(isset($key)){echo $key;}?>"/>
<label>Merchant Salt:</label>
<input type="text" name="salt" value="<?php if(isset($salt)){echo $salt;}?>"/>
<input type="hidden" name="provider" value="Payumoney"/>
<input type="submit" value="Submit" class="mybtn"/>
</form>
</div>

<div class="card-x" style="<?php if($display=='Pay2all'){echo 'display:block;';}else{echo 'display:none;';};?>">
<div style="text-align:center;margin-bottom:5px">Pay2all Api</div>
<form method="POST" action="" autocomplete="off">
<?php if(isset($msg1)){ echo $msg1;}?>
<label>API Key:</label>
<input type="text" name="key1" value="<?php if(isset($key1)){echo $key1;}?>"/>
<input type="hidden" name="provider" value="Pay2all"/>
<input type="submit" value="Submit" class="mybtn"/>
</form>
</div>
</body></html>