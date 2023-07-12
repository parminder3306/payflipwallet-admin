<?php
include("db.php");
include_once 'codes.php';
$source=(isset($_GET['source']))?$sp->real_escape_string(trim($_GET['source'])):'';

if($source == "alldata"){
$data = array();
$query= '';
$records_per_page = 30;
$start_from = 0;
$current_page_number = 0;
if(isset($_POST["rowCount"]))
{
 $records_per_page = $_POST["rowCount"];
}
else
{
 $records_per_page = 30;
}
if(isset($_POST["current"])){
 $current_page_number = $_POST["current"];
}else{
 $current_page_number = 1;
}
$start_from = ($current_page_number - 1) * $records_per_page;
$query .= "SELECT * FROM users ";
if(!empty($_POST["searchPhrase"])){
$query .= 'WHERE (name LIKE "%'.$_POST["searchPhrase"].'%" ';
 $query .= 'OR mobile LIKE "%'.$_POST["searchPhrase"].'%" ';
$query .= 'OR email LIKE "%'.$_POST["searchPhrase"].'%" ) ';
}
$order_by = '';
if(isset($_POST["sort"]) && is_array($_POST["sort"]))
{
 foreach($_POST["sort"] as $key => $value)
 {
  $order_by .= " $key $value, ";
 }
}else{
 $query .= 'ORDER BY uid';
}
if($order_by != ''){
 $query .= ' ORDER BY ' . substr($order_by, 0, -2);
}

if($records_per_page != -1){
 $query .= " LIMIT " . $start_from . ", " . $records_per_page;
}
$result = mysqli_query($sp, $query);
while($row = mysqli_fetch_assoc($result))
{
 $data[] = $row;
}

$query1 = "SELECT * FROM users";
$result1 = mysqli_query($sp, $query1);
$total_records = mysqli_num_rows($result1);

$output = array(
 'current'  => intval(isset($_POST["current"])),
 'rowCount'  => 10,
 'total'   => intval($total_records),
 'rows'   => $data
);
echo json_encode($output);
}

if($source == "add"){
$name=$_POST['name'];
$mobile=$_POST['mobile'];
$email=$_POST['email'];
$password=md5($_POST['password']);

$verify = mysqli_query($sp, "select * from users where email='".$email."' or mobile='".$mobile."'");
$row = mysqli_fetch_assoc($verify);		

if($row['mobile']==$mobile){
echo "Mobie Number is already register";
}
elseif($row['email']==$email){
echo "Email ID is already register";
}
elseif($verify->num_rows==0){
$add= "INSERT INTO users (type,access,wincash,spendmoney,wallet,refercode,name,email,mobile,password,accesskey,time,date)
 VALUES ('New','Active','0','0','0','".$refercodemaker."','".$name."','".$email."','".$mobile."','".$password."','".$accesskeymaker."','".$time."','".$date."')";
if($result = mysqli_query($sp, $add)){
echo "success";
}else{
echo "!error";
}	
}	
}

if($source == "details" && isset($_POST["uid"])){
 $query = "SELECT * FROM users WHERE uid = '".$_POST["uid"]."'";
 $result = mysqli_query($sp, $query);
 while($row = mysqli_fetch_assoc($result))
 {
  $output= $row;
 }
 echo json_encode($output);
}

if($source == "addmoney"){
$uid=$_POST['uid'];
$mobile=$_POST['mobile'];
$amount=$_POST['amount'];

$addmoney="INSERT INTO orders(uid,orderid,details,cashback,amount,status,operator,symbol,number,type,acnumber,time,date) 
 VALUES('$uid','$orderidmaker','AddMoney','$amount','$amount','Success','AddMoney','+','$mobile','AddMoney','','$time','$date')";
if($result = mysqli_query($sp, $addmoney)){
if(mysqli_query($sp,"update users set wallet=wallet + '$amount' where mobile='$mobile'"));
echo "Bouns Rs.".$amount." Successfully Added";
}else{
echo "!error";	
}	
}

if($source == "debit"){
$uid=$_POST['uid'];
$mobile=$_POST['mobile'];
$amount=$_POST['amount'];

$addmoney="INSERT INTO orders(uid,orderid,details,cashback,amount,status,operator,symbol,number,type,acnumber,time,date) 
 VALUES('$uid','$orderidmaker','Debit Cash','','$amount','Success','Debit Cash','-','$mobile','PaidMoney','','$time','$date')";
if($result = mysqli_query($sp, $addmoney)){
if(mysqli_query($sp,"update users set wallet=wallet - '$amount' where mobile='$mobile'"));
echo "Debit Rs.".$amount." Successfully Added";
}else{
echo "!error";	
}	
}

if($source == "edit"){
$name=$_POST['name'];
$mobile=$_POST['mobile'];
$email=$_POST['email'];
$access=$_POST['access'];
$update="update users set name='$name',mobile='$mobile',email='$email',access='$access' where mobile='$mobile'" ;
if($result = mysqli_query($sp, $update)){
echo "success";
}else{
echo "!error";	
}	
}

if($source == "delete"){
$query = "DELETE FROM users WHERE uid = '".$_POST['uid']."'";
if ($result = mysqli_query($sp, $query)) {
echo "Successfully Deleted";
}
}



?>
