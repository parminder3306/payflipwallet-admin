<?php
include_once 'db/db.php';
include_once 'codes.php';

$uid=(isset($_POST['uid']))?$sp->real_escape_string(trim($_POST['uid'])):'';
$checked=(isset($_POST['checked']))?$sp->real_escape_string(trim($_POST['checked'])):'';
$orderid=(isset($_POST['orderid']))?$sp->real_escape_string(trim($_POST['orderid'])):'';
$mobile=(isset($_POST['mobile']))?$sp->real_escape_string(trim($_POST['mobile'])):'';

if($uid){
$sql=mysqli_query($sp,"SELECT * FROM rewards WHERE uid='$uid' ORDER BY id DESC");
if($sql->num_rows==0){
echo "empty";
}else{
while($row = mysqli_fetch_assoc($sql)){
$rewards[]= $row;
}
echo json_encode($rewards); 
}
}
$query = mysqli_query($sp, "SELECT * FROM rewards WHERE orderid='$orderid'");
$row = mysqli_fetch_assoc($query);
$cashback=$row['cashback'];
$status=$row['status'];

if($checked == "true" && $status == "Processing"){
if(mysqli_query($sp,"INSERT INTO orders(uid,orderid,details,cashback,amount,status,operator,symbol,number,type,acnumber,time,date) 
VALUES('$uid','$orderidmaker','Cash Received','$cashback','$cashback','Success','Cash Received','+','$mobile','AddMoney','','$time','$date')"));
if(mysqli_query($sp, "update rewards set status='Success' where orderid='$orderid'"));
if(mysqli_query($sp,"update users set wallet=wallet + '$cashback' where uid='$uid'"));
if(mysqli_query($sp,"update users set wincash=wincash + '$cashback' where uid='$uid'"));
}
?>