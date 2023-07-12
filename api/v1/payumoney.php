<?php
include_once 'db/db.php';
include_once 'codes.php';

if(isset($_POST['key'])){
$key=(isset($_POST['key']))?$sp->real_escape_string(trim($_POST['key'])):'';
$txnid=(isset($_POST['txnid']))?$sp->real_escape_string(trim($_POST['txnid'])):'';
$amount=(isset($_POST['amount']))?$sp->real_escape_string(trim($_POST['amount'])):'';
$productinfo=(isset($_POST['productinfo']))?$sp->real_escape_string(trim($_POST['productinfo'])):'';
$firstname=(isset($_POST['firstname']))?$sp->real_escape_string(trim($_POST['firstname'])):'';
$email=(isset($_POST['email']))?$sp->real_escape_string(trim($_POST['email'])):'';
$salt="HIb5GCmjIB";
$hashSeq = $key.'|'.$txnid.'|'.$amount.'|'.$productinfo.'|'.$firstname.'|'.$email.'|||||||||||'.$salt;
echo hash("sha512", $hashSeq);
}



if(isset($_POST['status'])){
$uid=(isset($_POST['uid']))?$sp->real_escape_string(trim($_POST['uid'])):'';
$amount=(isset($_POST['amount']))?$sp->real_escape_string(trim($_POST['amount'])):'';
$mobile=(isset($_POST['mobile']))?$sp->real_escape_string(trim($_POST['mobile'])):'';
$status=(isset($_POST['status']))?$sp->real_escape_string(trim($_POST['status'])):'';
if(mysqli_query($sp,"INSERT INTO orders(uid,orderid,details,cashback,amount,status,operator,symbol,number,type,acnumber,time,date) 
 VALUES('$uid','$orderidmaker','AddMoney','$amount','$amount','$status','AddMoney','+','$mobile','AddMoney','','$time','$date')"));

if($status=="Success"){
if(mysqli_query($sp,"update users set wallet=wallet + '$amount' where uid='$uid'"));
}

}




?>