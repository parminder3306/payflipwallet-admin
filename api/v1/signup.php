<?php
include_once 'db/db.php';
include_once 'codes.php';

$name=(isset($_POST['name']))?$sp->real_escape_string(trim($_POST['name'])):'';
$mobile=(isset($_POST['mobile']))?$sp->real_escape_string(trim($_POST['mobile'])):'';
$email=(isset($_POST['email']))?$sp->real_escape_string(trim($_POST['email'])):'';
$password=md5((isset($_POST['password']))?$sp->real_escape_string(trim($_POST['password'])):'');
$serial=(isset($_POST['serial']))?$sp->real_escape_string(trim($_POST['serial'])):'';
$verify = mysqli_query($sp, "select * from users where email='$email' or mobile='$mobile'");
$row = mysqli_fetch_assoc($verify);	

if (empty($name) && empty($mobile) && empty($email) && empty($password) && empty($serial))  {
$error = true;
}
elseif (mysqli_query($sp, "select * from devices where serial='$serial'")->num_rows == 1)  {
$error = true;
echo json_encode(array("msg" =>"Device is already Register"));
}
if (!$error) {	
if($row['mobile']==$mobile){
echo json_encode(array("msg" =>"Mobie Number is already register"));
}
elseif($row['email']==$email){
echo json_encode(array("msg" =>"Email ID is already register"));
}
elseif($verify->num_rows==0){
$add= "INSERT INTO users (type,access,wincash,spendmoney,wallet,refercode,name,email,mobile,password,accesskey,time,date)
 VALUES ('New','Active','0','0','0','$refercodemaker','$name','$email','$mobile','$password','$accesskeymaker','$time','$date')";
$add1= "INSERT INTO devices (serial,token,accesskey)VALUES ('$serial','','$accesskeymaker')";
if(mysqli_query($sp, $add) && mysqli_query($sp, $add1)){
echo json_encode(array("msg" => "success"));
}else{
echo json_encode(array("msg" =>"Oops! Something went wrong"));
}	
}	
}
?>