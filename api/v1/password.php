<?php
include_once 'db/db.php';
include_once 'codes.php';
$accesskey=(isset($_POST['accesskey']))?$sp->real_escape_string(trim($_POST['accesskey'])):'';
$oldpassword=md5((isset($_POST['oldpassword']))?$sp->real_escape_string(trim($_POST['oldpassword'])):'');
$newpassword=md5((isset($_POST['newpassword']))?$sp->real_escape_string(trim($_POST['newpassword'])):'');

$verify = mysqli_query($sp, "select * from users where accesskey='$accesskey' and password='$oldpassword'"); 


if (empty($_POST["oldpassword"]))  {
$error = true;
}
elseif (strlen($_POST["oldpassword"]) < 6)  {
$error = true;
}
elseif (empty($_POST["newpassword"]))  {
$error = true;
}
elseif (strlen($_POST["newpassword"]) < 6)  {
$error = true;
}     
elseif ($oldpassword == $newpassword)  {
$error = true;
echo json_encode(array("msg" =>"old and new password is same."));
}

if (!$error) {
if($verify->num_rows>0){
$update="update users set password='$newpassword' where accesskey='$accesskey'";
if(mysqli_query($sp, $update)){
echo json_encode(array("msg" =>"Password is Changed Successfully!"));
}
}else{
echo json_encode(array("msg" =>"Wrong Old Password !"));
}
}
?>