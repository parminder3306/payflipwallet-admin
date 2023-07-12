<?php
include_once 'db/db.php';
include_once 'codes.php';
$email=(isset($_POST['email']))?$sp->real_escape_string(trim($_POST['email'])):'';
if (empty($email)) {
$error = true;
}
if(isset($email)){
$sql = "SELECT * FROM users where email='".$email."'";
$query = mysqli_query($sp,$sql);
$row = mysqli_fetch_array($query);
$email=$row['email'];         
if(count($row)>=1){
$to=$email;
$subject="Your Password Reset Link";
$from = 'care@payflipwallet.com("Payflip Wallet")';
$body='<b>Dear, '.$row['name'].' <br><br>Click here to Reset your password https://payflipwallet.com/api/v1/resetpassword?code='.$row['accesskey'].'   <br><br>Payflip Systems,<br>Thanks for You<br><br><b>';
$headers = "From: " . strip_tags($from) . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
mail($to,$subject,$body,$headers);
echo json_encode(array("msg" =>"We have e-mailed your password reset link !"));
}else{
echo json_encode(array("msg" =>"Users not exits"));
}
}
?>