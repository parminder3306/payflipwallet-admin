<?php
$reward=false;
include_once 'db/db.php';
include_once 'codes.php';
$uid=(isset($_POST['uid']))?$sp->real_escape_string(trim($_POST['uid'])):'';
$mobile=(isset($_POST['mobile']))?$sp->real_escape_string(trim($_POST['mobile'])):'';
$promocode=(isset($_POST['promocode']))?$sp->real_escape_string(trim($_POST['promocode'])):'';
$cashback=(isset($_POST['cashback']))?$sp->real_escape_string(trim($_POST['cashback'])):'';
$amount=(isset($_POST['amount']))?$sp->real_escape_string(trim($_POST['amount'])):'';
$openable=(isset($_POST['openable']))?$sp->real_escape_string(trim($_POST['openable'])):'';

$query = mysqli_query($sp,"select * from redeem where promocode='$promocode' and uid='$uid'");
$redeem = mysqli_fetch_assoc($query);

$access = mysqli_query($sp, "select * from users where uid='$uid'");
$token1 = mysqli_fetch_assoc($access);
$uid=$token1['uid'];
$mobi=$token1['mobile'];
$wallet=$token1['wallet'];
$name=$token1['name'];

$resultset = mysqli_query($sp, "select * from users where mobile='$mobile'");
$row = mysqli_fetch_assoc($resultset);	
$count1=$resultset->num_rows;
$fname=$row['name'];
$fid=$row['uid'];
$flock=$row['access'];
$fmobile=$row['mobile'];
if(empty($_POST["mobile"]))  {
$error = true;
}
elseif(!preg_match("/^[0-9]+$/",$mobile)) {
$error = true;
}
elseif(strlen($_POST["mobile"]) < 10)  {
$error = true;
}
elseif(empty($_POST["amount"])) {
$error = true;
}
elseif(!preg_match("/^[0-9]+$/",$amount)){
$error = true;
}
elseif($amount < 10)  {
$error = true;
}
elseif($amount > 5000)  {
$error = true;

}	
if (!$error) {
if($count1==0){
echo json_encode(array("msg" =>"$mobile user not exits"));
}
elseif($mobi==$mobile){
echo json_encode(array("msg" =>"Cannot send money to yourself"));
}
elseif($flock=='Block'){
echo json_encode(array("msg" =>"$mobile is locked"));
}	
elseif ($wallet >= $amount) {
if(mysqli_query($sp,"update users set wallet=wallet - '$amount' where uid='$uid'"));
if(mysqli_query($sp,"update users set spendmoney=spendmoney + '$amount' where uid='$uid'"));
if(mysqli_query($sp,"update users set wallet=wallet + '$amount' where mobile='$mobile'"));
if(mysqli_query($sp,"INSERT INTO orders(uid,orderid,details,cashback,amount,status,operator,symbol,number,type,acnumber,time,date) 
VALUES('$uid','$orderidmaker','SendMoney To: $fmobile','','$amount','Success','SendMoney','-','$mobi','SendMoney','','$time','$date')"));
if(mysqli_query($sp,"INSERT INTO orders(uid,orderid,details,cashback,amount,status,operator,symbol,number,type,acnumber,time,date) 
 VALUES('$fid','$orderidmaker1','ReceivedMoney From: $mobi','','$amount','Success','ReceivedMoney','+','$fmobile','ReceivedMoney','','$time','$date')"));

if($cashback){
$reward="Yes";
if(mysqli_query($sp,"INSERT INTO rewards(uid,cashback,orderid,symbol,time,date,status,openable) 
VALUES('$uid','$cashback','$orderidmaker','+','$time','$date','Processing','$openable')"));
if(mysqli_query($sp,"update coupons set total_redeem=total_redeem+'1' where promocode='$promocode'"));
}
if(count($redeem["promocode"])==0 && $promocode){
if(mysqli_query($sp, "INSERT INTO redeem(uid,promocode,redeem,time,date) VALUES('$uid','$promocode','1','$time','$date')"));
}else{
if(mysqli_query($sp,"update redeem set redeem=redeem+'1' where promocode='$promocode' and uid='$uid'"));
}
if (mysqli_query($sp,"DELETE FROM notifications WHERE status = 'Processing'"));
echo json_encode(array("msg"=>"success","orderid" =>$orderidmaker,"date" =>$date,"time" =>$time,"reward" =>$reward));
}
elseif  ($wallet >= 0.99) { 
echo json_encode(array("msg"=>"insufficient balance"));
}else{
echo json_encode(array("msg"=>"insufficient balance"));
}
}
?>
