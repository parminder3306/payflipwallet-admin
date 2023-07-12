<?php
include_once 'db/db.php';
include_once 'codes.php';
$uid=(isset($_POST['uid']))?$sp->real_escape_string(trim($_POST['uid'])):'';
$promo=(isset($_POST['promocode']))?$sp->real_escape_string(trim($_POST['promocode'])):'';
$promocode=strtoupper($promo);
if(isset($promo)){
$query = mysqli_query($sp,"select * from redeem where promocode='$promocode' and uid='$uid'");
$row = mysqli_fetch_array($query);

$query1 = mysqli_query($sp,"select * from coupons where promocode='$promocode'");
$row1 = mysqli_fetch_array($query1);
$validity=$row1['validity'];
$discount = ($row1['percent'] / 100) * $row1['apply_max'];

$query2 = mysqli_query($sp,"select * from users where uid='$uid'");
$status=false;
$status1=false;

if(empty($promo)){
$error=true;	
}
elseif(empty($uid)){
echo json_encode(array("msg" =>"uid is Required"));
$error=true;	
}
elseif($query1->num_rows==0){
echo json_encode(array("msg" =>"This is an invaild code.Please confirm your code and try again."));
$error=true;	
}
elseif($query2->num_rows==0){
echo json_encode(array("msg" =>"Users not exits"));
$error=true;	
}
elseif($row1['redeem'] == $row1['users']){
if(mysqli_query($sp, "update coupons set status='Expire' where promocode='$promocode'"));
if(mysqli_query($sp, "delete from redeem where promocode='$promocode'"));
echo json_encode(array("msg" =>"Sorry, this offer has expired"));
$error=true;	
}
elseif($row['redeem'] == $row1['apply_uses']){
echo json_encode(array("msg" =>"Offers already redeem"));
$error=true;	
}
if(!$error){
if($query1->num_rows==1){
$status="success";
}else{
echo json_encode(array("msg" =>"This is an invaild code.Please confirm your code and try again."));
$status==false;	
}
if($row1['apply']!=='AddMoney'){	
echo json_encode(array("msg" =>"this promocode only use for recharge/bill payments"));
$status==false;	
}
elseif($validity >= $dateverify){
$status1="success";
}else{
echo json_encode(array("msg" =>"Sorry, this offer has expired"));
$status==false;	
}	
if($status=="success" && $status1=="success"){
if(count($row["promocode"]) ==0 ){
if(mysqli_query($sp, "INSERT INTO redeem(uid,promocode,redeem,time,date) VALUES('$uid','$promocode','1','$time','$date')"));
}else{
if(mysqli_query($sp,"update redeem set redeem=redeem+'1' where promocode='$promocode' and uid='$uid'"));
}
if(mysqli_query($sp,"INSERT INTO orders(uid,orderid,details,cashback,amount,status,operator,symbol,number,type,acnumber,time,date) 
 VALUES('$uid','$orderidmaker','AddMoney','$discount','$discount','Success','AddMoney','+','','AddMoney','','$time','$date')"));

if(mysqli_query($sp,"update coupons set total_redeem=total_redeem+'1' where promocode='$promocode'"));
if(mysqli_query($sp,"update users set wallet=wallet + '$discount' where uid='$uid'"));
echo json_encode(array("msg"=>"success","orderid" =>$orderidmaker,"amount" =>$discount,"date" =>$date,"time" =>$time));

}
}
}
?>