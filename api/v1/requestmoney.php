<?php
include_once 'db/db.php';
include_once 'codes.php';
$name=(isset($_POST['name']))?$sp->real_escape_string(trim($_POST['name'])):'';
$mymobile=(isset($_POST['mymobile']))?$sp->real_escape_string(trim($_POST['mymobile'])):'';
$mobile=(isset($_POST['mobile']))?$sp->real_escape_string(trim($_POST['mobile'])):'';
$amount=(isset($_POST['amount']))?$sp->real_escape_string(trim($_POST['amount'])):'';


$y = mysqli_query($sp, "select * from users where mobile='$mobile'");
$count=$y->num_rows;
$row = mysqli_fetch_assoc($y);	
$accesskey=$row['accesskey'];

if(empty($_POST["name"]))  {
$error = true;
}
elseif(empty($_POST["mymobile"]))  {
$error = true;
}
elseif(empty($_POST["mobile"]))  {
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
if($count==0){
echo json_encode(array("msg" =>"$mobile user not exits"));
}elseif($mymobile==$mobile){
echo json_encode(array("msg" =>"Cannot send money to yourself"));
}else{
if(mysqli_query($sp,"INSERT INTO notifications (senderid,accesskey,title,message,name,mobile,amount,status) 
VALUES('$senderid','$accesskey','RequestMoney','Request Rs.$amount from $name','$name','$mymobile','$amount','Processing')")){
$result=mysqli_query($sp,"SELECT * FROM devices WHERE accesskey='$accesskey'");
$count=$result->num_rows;
while($row = mysqli_fetch_assoc($result)){ 
$notification = array('title' =>'Request Money' , 'body' =>'Request Rs.'.$amount.' From Parminder Singh', 'sound' => 'default', 'badge' => '1', 'click_action' => 'RequestPay');
$arrayToSend = array('to' => $row["token"], 'notification' => $notification,'priority'=>'high');
$url = "https://fcm.googleapis.com/fcm/send";
$serverKey = 'AIzaSyDw-QgJfOeH1SWWJvkaRtodaaq8f69vQZ0';
$json = json_encode($arrayToSend);
$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Authorization: key='. $serverKey;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
$response = curl_exec($ch);
curl_close($ch);
}
echo json_encode(array("msg"=>"Request is Successfully Sent"));	
}else{
echo json_encode(array("msg"=>"!Oops something went wrong"));		
}	
}
}
?>
