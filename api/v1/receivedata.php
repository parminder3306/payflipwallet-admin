<?php
include_once 'db/db.php';
$uid=(isset($_POST['uid']))?$sp->real_escape_string(trim($_POST['uid'])):'';
$serial=(isset($_POST['serial']))?$sp->real_escape_string(trim($_POST['serial'])):'';
$token=(isset($_POST['token']))?$sp->real_escape_string(trim($_POST['token'])):'';

if($uid){
$result = mysqli_query($sp,"select * from users where uid='".$uid."'");
$user=mysqli_fetch_assoc($result);

$result1=mysqli_query($sp,"SELECT * FROM referprogram");
$refer = mysqli_fetch_assoc($result1);
if($result->num_rows==1){
if(mysqli_query($sp,"update devices set token='$token' where serial='$serial'"));
echo json_encode($user);	
}
}
?>	