<?php
include_once 'session.php';
include_once 'codes.php';
$sql   = "SELECT * FROM referprogram";
$result=mysqli_query($sp,$sql);
$count = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
$offer=$row['offer'];
$url=$row['url'];
$money=$row['money'];
if(isset($_POST['submit'])) 
{
$offer=(isset($_POST['offer']))?$sp->real_escape_string(trim($_POST['offer'])):'';
$url=(isset($_POST['url']))?$sp->real_escape_string(trim($_POST['url'])):'';
$money=(isset($_POST['money']))?$sp->real_escape_string(trim($_POST['money'])):'';

if (empty($offer))  {
$error = true;
$msg='<div class="msgred">Please Enter Refer offer</div>';
}
elseif (empty($url))  {
$error = true;
$msg='<div class="msgred">Please Enter Refer Url</div>';
}
elseif (empty($money))  {
$error = true;
$msg='<div class="msgred">Please Enter Refer money</div>';
}
if(!$error){
if($count=="0"){ 
$sql1    = "INSERT INTO referprogram(offer,url,money)VALUES('$offer','$url','$money')"; 
$result1 = mysqli_query($sp,$sql1);
$msg='<div class="msggreen">Data is Succesfully Insert</div>';
}
else {
$sql4    = "update referprogram set offer='$offer',url='$url',money='$money' where url='$url'"; 
$result4 = mysqli_query($sp,$sql4); 
$msg='<div class="msggreen">Data is Succesfully Update</div>';
}  
}  
}   
?>