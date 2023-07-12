<?php
include_once 'session.php';
include_once 'codes.php';

$provider=(isset($_POST['provider']))?$sp->real_escape_string(trim($_POST['provider'])):'';
$count=mysqli_query($sp,"SELECT * FROM setup where provider='$provider'")->num_rows;

if($provider=="Payumoney") {
$key=trim($_POST['key']);
$salt=trim($_POST['salt']);
	
if (empty($key))  {
$error = true;
$msg='<div class="msgred">Please Enter Merchant Key</div>';
}
elseif (empty($salt))  {
$error = true;
$msg='<div class="msgred">Please Enter Merchant Salt</div>';
}
if(!$error){
if($count=="0"){ 
if(mysqli_query($sp, "INSERT INTO setup(provider,s_key,s_salt)VALUES('$provider','$key','$salt')"));
$msg='<div class="msggreen">Data is Succesfully Insert</div>';
}
else {
if(mysqli_query($sp,"update setup set s_key='$key',s_salt='$salt' where  provider='$provider'")); 
$msg='<div class="msggreen">Data is Succesfully Update</div>';
}  
}  
}  
if($provider=="Pay2all") {
$key1=trim($_POST['key1']);
if (empty($key1))  {
$error = true;
$msg1='<div class="msgred">Please Enter Api Key</div>';
}
if(!$error){
if($count=="0"){ 
if(mysqli_query($sp, "INSERT INTO setup(provider,s_key,s_salt)VALUES('$provider','$key1','')"));
$msg1='<div class="msggreen">Data is Succesfully Insert</div>';
}
else {
if(mysqli_query($sp,"update setup set s_key='$key1' where  provider='$provider'")); 
$msg1='<div class="msggreen">Data is Succesfully Update</div>';
}  
}  
}   
?>