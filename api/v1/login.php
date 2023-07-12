<?php
include_once 'db/db.php';
include_once 'codes.php';
$serial=(isset($_POST['serial']))?$sp->real_escape_string(trim($_POST['serial'])):'';;
$mobile=(isset($_POST['mobile']))?$sp->real_escape_string(trim($_POST['mobile'])):'';
$password=md5((isset($_POST['password']))?$sp->real_escape_string(trim($_POST['password'])):'');
$verify = mysqli_query($sp, "select * from users where mobile='$mobile'");
$row = mysqli_fetch_assoc($verify);	
$device= mysqli_query($sp, "select * from devices where serial='$serial'");

if (empty($_POST["mobile"]))  {
$error = true;
}
elseif (empty($_POST["password"]))  {
$error = true;
}
elseif (strlen($_POST["password"]) < 6)  {
$error = true;
}	
if (!$error) {
if($verify->num_rows<1){
echo json_encode(array("msg" =>"Invaild username and Password!"));
}
elseif($row['access']=='Block'){
echo json_encode(array("msg" =>"Account is locked"));
}
elseif($row['password']==$password){
echo json_encode(array(
"msg" => "success",
"uid" => $row["uid"],
"accesskey" => $row["accesskey"],
"name" => $row["name"],
"mobile" => $row["mobile"],	
"email" => $row["email"],	
"refercode" => $row["refercode"],	
"wincash" => $row["wincash"],	
"spendmoney" => $row["spendmoney"],	
"wallet" => $row["wallet"]));
if($device->num_rows==0){
if(mysqli_query($sp,"INSERT INTO devices (serial,token,accesskey)VALUES ('$serial','','".$row["accesskey"]."')"));	
}else{
if(mysqli_query($sp,"update devices set accesskey='".$row["accesskey"]."' where serial='$serial'"));
}
}else{
echo json_encode(array("msg" =>"Wrong Password"));
}	
}
?>