<?php
include_once 'db/db.php';
include_once 'codes.php';
$uid=(isset($_POST['uid']))?$sp->real_escape_string(trim($_POST['uid'])):'';
$opid=(isset($_POST['opid']))?$sp->real_escape_string(trim($_POST['opid'])):'';
$oplogo=(isset($_POST['oplogo']))?$sp->real_escape_string(trim($_POST['oplogo'])):'';
$opname=(isset($_POST['opname']))?$sp->real_escape_string(trim($_POST['opname'])):'';
$mobile=(isset($_POST['mobile']))?$sp->real_escape_string(trim($_POST['mobile'])):'';
$amount=(isset($_POST['amount']))?$sp->real_escape_string(trim($_POST['amount'])):'';
$date=(isset($_POST['date']))?$sp->real_escape_string(trim($_POST['date'])):'';
$type=(isset($_POST['type']))?$sp->real_escape_string(trim($_POST['type'])):'';

$y = mysqli_query($sp, "select * from autopay where mobile='$mobile'");
$count=$y->num_rows;	

if ($uid && $opid && $opname && $mobile && $amount && $date && $type) {
if($count==0){
if(mysqli_query($sp,"INSERT INTO autopay (uid,opid,opname,oplogo,mobile,amount,date,type) 
VALUES('$uid','$opid','$opname','$oplogo','$mobile','$amount','$date','$type')")){
echo json_encode(array("msg"=>"Successfully added"));		
}else{
echo json_encode(array("msg"=>"!Oops something went wrong"));		
}	
}else{
echo json_encode(array("msg" =>"already exits"));		
}
}
?>
