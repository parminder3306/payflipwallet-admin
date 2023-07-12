<?php
session_start();
if(isset($_SESSION['adminsession'])!=""){
header('location:/admin');
}
include_once("db.php");
include_once("codes.php");
if(isset($_POST['login'])) {
$pin = trim($_POST['pin']);
if (empty($pin))  {
$error = true;
$msg='<div class="msgred">Please Enter OTP PIN</div>';
}
if(!$error){
$sql = "SELECT * FROM admin WHERE pin='$pin'";
$resultset = mysqli_query($sp, $sql) or die("database error:". mysqli_error($sp));
$row = mysqli_fetch_assoc($resultset);	
$token=$row['token'];	
if($row['pin']==$pin){				
$_SESSION['adminsession'] =$token;
$msg='<div class="msggreen">Welcome '.$row['ceo'].'</div>';
header('refresh:2;/admin');
} else {				
$msg='<div class="msgred">Wrong OTP PIN</div>';
}		
}
}
?>