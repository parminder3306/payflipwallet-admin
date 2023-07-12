<?php
$ceo=false;
$website=false;
session_start();
include_once 'db.php';
if(!isset($_SESSION['adminsession']))
{
	header("Location:login");
}else{
$query = "select * from admin where id='".$_SESSION['adminsession']."'";
$result = mysqli_query($sp,$query);
$row = mysqli_fetch_array($result);
$aid=$row['id'];
$ceo=$row['ceo'];
}
?>  