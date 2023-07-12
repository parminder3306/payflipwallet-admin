<?php
$status=false;
$reward=false;
$payment=false;
include_once 'db/db.php';
include_once 'codes.php';
$uid=(isset($_POST['uid']))?$sp->real_escape_string(trim($_POST['uid'])):'';
$type=(isset($_POST['type']))?$sp->real_escape_string(trim($_POST['type'])):'';
$opid=(isset($_POST['opid']))?$sp->real_escape_string(trim($_POST['opid'])):'';
$opname=(isset($_POST['opname']))?$sp->real_escape_string(trim($_POST['opname'])):'';
$amount=(isset($_POST['amount']))?$sp->real_escape_string(trim($_POST['amount'])):'';
$number=(isset($_POST['number']))?$sp->real_escape_string(trim($_POST['number'])):'';
$acnumber=(isset($_POST['acnumber']))?$sp->real_escape_string(trim($_POST['acnumber'])):'';
$promocode=(isset($_POST['promocode']))?$sp->real_escape_string(trim($_POST['promocode'])):'';
$cashback=(isset($_POST['cashback']))?$sp->real_escape_string(trim($_POST['cashback'])):'';
$openable=(isset($_POST['openable']))?$sp->real_escape_string(trim($_POST['openable'])):'';

$query = mysqli_query($sp,"select * from redeem where promocode='$promocode' and uid='$uid'");
$redeem = mysqli_fetch_assoc($query);

$result = mysqli_query($sp, "select * from users where uid='$uid'");
$user=mysqli_fetch_assoc($result);

if($type == "Recharge" || $type == "DTH" || $type == "Landline" || $type == "Electricity"){
if ($user['wallet'] >= $amount || $amount < 10)  {
if(mysqli_query($sp, "update users set wallet=wallet - '$amount' ,spendmoney=spendmoney + '$amount' where uid='$uid'"));
$payment="Success";	
}else{
$status="Nobalance";
$payment="Failure";	
}
}
if($type == "Recharge" && $payment == "Success"){
$curl_error="";
$ch = curl_init();
$url ='https://www.pay2all.in/web-api/paynow?api_token=kGfJGdYl424dcLpTuEUhxNea3lNDgdlNdurTmUw9gIWzvmRMUhzdEUk0uJNC&number='.$number.'&provider_id='.$opid.'&amount='.$amount.'&client_id='.$orderidmaker.'';	
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_HEADER, 0);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 131);
$file_contents = curl_exec($ch);
$curl_error = curl_errno($ch);
$jsondata = json_decode($file_contents, true);
curl_close($ch);
if($curl_error){
$status="Opps";
}else{
if(ucfirst($jsondata{'status'})=="Success" || ucfirst($jsondata{'status'})=="Failure"){$status="Success";}else{$status="Processing";}
if(mysqli_query($sp,"INSERT INTO orders(uid,orderid,details,cashback,amount,status,operator,symbol,number,type,acnumber,time,date) 
VALUES('$uid','$orderidmaker','Recharge $opname','$cashback','$amount','$status','$opname','-','$number','PaidMoney','$acnumber','$time','$date')"));				
}
}
if($type == "DTH" && $payment == "Success"){
$curl_error="";
$ch = curl_init();
$url = 'https://www.pay2all.in/web-api/paynow?api_token=kGfJGdYl424dcLpTuEUhxNea3lNDgdlNdurTmUw9gIWzvmRMUhzdEUk0uJNC&number='.$number.'&provider_id='.$opid.'&amount='.$amount.'&client_id='.$orderidmaker.'&cnumber='.$user['mobile'].'';
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_HEADER, 0);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 131);
$file_contents = curl_exec($ch);
$curl_error = curl_errno($ch);
$jsondata = json_decode($file_contents, true);
curl_close($ch);

if($curl_error){
$status="Opps";
}else{
if(ucfirst($jsondata{'status'})=="Success" || ucfirst($jsondata{'status'})=="Failure"){$status=ucfirst($jsondata{'status'});}else{$status="Processing";}		
if(mysqli_query($sp,"INSERT INTO orders(uid,orderid,details,cashback,amount,status,operator,symbol,number,type,acnumber,time,date) 
VALUES('$uid','$orderidmaker','Recharge $opname','$cashback','$amount','$status','$opname','-','$number','PaidMoney','$acnumber','$time','$date')"));				
}
}
if($type == "Landline" || $type == "Electricity" && $payment == "Success"){
if($cashback){
$reward="Yes";
$status="Processing";
if(mysqli_query($sp,"INSERT INTO rewards(uid,cashback,orderid,symbol,time,date,status,openable) 
VALUES('$uid','$cashback','$orderidmaker','+','$time','$date','Processing','$openable')"));
if(mysqli_query($sp,"update coupons set total_redeem=total_redeem+'1' where promocode='$promocode'"));
}
if(count($redeem["promocode"])==0 && $promocode){
if(mysqli_query($sp, "INSERT INTO redeem(uid,promocode,redeem,time,date) VALUES('$uid','$promocode','1','$time','$date')"));
}else{
if(mysqli_query($sp,"update redeem set redeem=redeem+'1' where promocode='$promocode' and uid='$uid'"));
}
if(mysqli_query($sp,"INSERT INTO orders(uid,orderid,details,cashback,amount,status,operator,symbol,number,type,acnumber,time,date) 
VALUES('$uid','$orderidmaker','Bill $opname','$cashback','$amount','Processing','$opname','-','$number','PaidMoney','$acnumber','$time','$date')"));		
}

if($status=="Success"){
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
}
if($status){
echo json_encode(array("msg"=>$status,"orderid"=>$orderidmaker,"time"=>$time,"date"=>$date,"reward"=>$reward));
}

?>