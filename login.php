<?php
session_start();
if(isset($_SESSION['adminsession'])!=""){
header('location:/admin');
}
include_once("auth/db.php");
include_once("auth/codes.php");
if(isset($_POST['login'])) {
$pin = trim($_POST['pin']);
if (empty($pin))  {
$error = true;
$msg='<div class="msgred">Please Enter OTP PIN</div>';
}
if(!$error){
$sql = "SELECT * FROM admin WHERE pin='$pin'";
$resultset = mysqli_query($sp, $sql);
$row = mysqli_fetch_assoc($resultset);	
$id=$row['id'];	
if($row['pin']==$pin){				
$_SESSION['adminsession'] =$id;
$msg='<div class="msggreen">Welcome '.$row['ceo'].'</div>';
header('refresh:2;/admin');
} else {				
$msg='<div class="msgred">Wrong OTP PIN</div>';
}		
}
}
?>
<!DOCTYPE html>
<html lang='en-US'>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width = device-width">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="robots" content="index, follow">
<title>Admin Login</title>
<link rel="stylesheet" href="/admin/css/style.css" type="text/css" media="all">
</head>
<body>
<div style="text-align:center;margin-top:70px;font-size:20px;color:#671d5f">PAYFLIPWALLET</div>
<center>
<div class="card-x" style="left:0;float:none;">
<?php if(isset($msg)){ echo $msg;}?>
<form method="POST" action="" autocomplete="off">
<input type="tel" name="pin" maxlength="4" placeholder="Enter OTP PIN">
<button type="submit" name="login" class="mybtn">Login</button>
</form>
</div>
</center>
</body></html>