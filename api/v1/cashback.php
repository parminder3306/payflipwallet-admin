<?php
include_once 'db/db.php';
include_once 'codes.php';

$apply=(isset($_POST['apply']))?$sp->real_escape_string(trim($_POST['apply'])):'';
$amount=(isset($_POST['amount']))?$sp->real_escape_string(trim($_POST['amount'])):'';
$uid=(isset($_POST['uid']))?$sp->real_escape_string(trim($_POST['uid'])):'';

$query = mysqli_query($sp,"select * from coupons where apply='$apply'");
$row = mysqli_fetch_array($query);
$count=$query->num_rows;
$openable=$row['openable'];
$promocode=$row['promocode'];
$validity=$row['validity'];
$cashback =($row['percent'] / 100) * $amount;

$redeem = mysqli_query($sp, "select * from redeem where promocode='$promocode' and uid='$uid'");
$redeemrow = mysqli_fetch_array($redeem);

if(empty($amount)){
$error=true;	
}
elseif(empty($uid)){
$error=true;	
}
elseif(empty($apply)){
$error=true;	
}
elseif($row['apply_min'] > $amount || $amount > $row['apply_max']){			
$error=true;		
}
elseif($row['redeem'] == $row['users']){
if(mysqli_query($sp, "update coupons set status='Expire' where promocode='$promocode'"));
if(mysqli_query($sp, "delete from redeem where promocode='$promocode'"));
$error=true;	
}
elseif($redeemrow['redeem'] == $row['apply_uses']){
$error=true;	
}
elseif(!$error || $count==1){
echo json_encode(array("promocode" =>$promocode,"cashback" =>$cashback,"openable" =>$openable));	
}
?>