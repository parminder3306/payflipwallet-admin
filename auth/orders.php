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
$query .= "SELECT * FROM orders ";
if(!empty($_POST["searchPhrase"])){
$query .= 'WHERE (status LIKE "%'.$_POST["searchPhrase"].'%" ';
$query .= 'OR uid LIKE "%'.$_POST["searchPhrase"].'%" ';
$query .= 'OR orderid LIKE "%'.$_POST["searchPhrase"].'%" ';
$query .= 'OR number LIKE "%'.$_POST["searchPhrase"].'%" ';
$query .= 'OR date LIKE "%'.$_POST["searchPhrase"].'%" ) ';
}
$order_by = '';
if(isset($_POST["sort"]) && is_array($_POST["sort"]))
{
 foreach($_POST["sort"] as $key => $value)
 {
  $order_by .= " $key $value, ";
 }
}else{
 $query .= 'ORDER BY id';
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

$query1 = "SELECT * FROM orders";
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

if($source == "details" && isset($_POST["id"])){
 $query = "SELECT * FROM orders WHERE id = '".$_POST["id"]."'";
 $result = mysqli_query($sp, $query);
 while($row = mysqli_fetch_assoc($result))
 {
  $output= $row;
 }
 echo json_encode($output);
}

if($source == "refund"){
$uid=$_POST['uid'];
$orderid=$_POST['orderid'];
$number=$_POST['number'];
$amount=$_POST['amount'];

$addmoney="INSERT INTO orders(uid,orderid,details,cashback,amount,status,operator,symbol,number,type,acnumber,time,date) 
 VALUES('$uid','$orderidmaker','RefundMoney','$amount','$amount','Success','RefundMoney','+','$number','RefundMoney','','$time','$date')";
if($result = mysqli_query($sp, $addmoney)){
if(mysqli_query($sp,"update users set wallet=wallet + '$amount' where uid='$uid'"));
if(mysqli_query($sp,"update orders set status='Refund' where orderid='$orderid'"));
echo "Refund Successfully";
}else{
echo "!error";	
}	
}

if($source == "edit"){
$update="update orders set status='".$_POST['status']."' where id='".$_POST['id']."'" ;
if($result = mysqli_query($sp, $update)){
echo "success";
}else{
echo "!error";	
}	
}

if($source == "delete"){
$query = "DELETE FROM orders WHERE id = '".$_POST['id']."'";
if ($result = mysqli_query($sp, $query)) {
echo "Successfully Deleted";
}
}



?>
