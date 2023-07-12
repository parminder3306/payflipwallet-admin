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
$query .= "SELECT * FROM autopay ";
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

$query1 = "SELECT * FROM autopay";
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
 $query = "SELECT * FROM autopay WHERE id = '".$_POST["id"]."'";
 $result = mysqli_query($sp, $query);
 while($row = mysqli_fetch_assoc($result))
 {
  $output= $row;
 }
 echo json_encode($output);
}

if($source == "payment"){
$uid=$_POST["uid"];
$opname=$_POST["opname"];
$opid=$_POST["opid"];
$amount=$_POST["amount"];		
$number=$_POST["number"];		
$acnumber="";		
$cashback="";		
$result = mysqli_query($sp, "SELECT * FROM users where uid='$uid'");
$user = mysqli_fetch_assoc($result);
if ($user['wallet'] >= $amount || $amount < 10)  {
if(mysqli_query($sp, "update users set wallet=wallet - '$amount' ,spendmoney=spendmoney + '$amount' where uid='$uid'"));
$curl_error="";
$ch = curl_init();
$url ='https://www.pay2all.in/web-api/paynow?api_token=9t9BGCs1OEY8ysAQSFLXIfVB8nMJlXPCyaR81B0kGRav5PvVo7J3E28bIw94&number='.$number.'&provider_id='.$opid.'&amount='.$amount.'&client_id='.$orderidmaker.'';	
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_HEADER, 0);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 131);
$file_contents = curl_exec($ch);
$curl_error = curl_errno($ch);
$jsondata = json_decode($file_contents, true);
curl_close($ch);
if($curl_error){
$status="Opps";
}else{
if(ucfirst($jsondata{'status'})=="Success" || ucfirst($jsondata{'status'})=="Failure"){$status=ucfirst($jsondata{'status'});}else{$status="Processing";}
if(mysqli_query($sp,"INSERT INTO orders(uid,orderid,details,cashback,amount,status,operator,symbol,number,type,acnumber,time,date) 
VALUES('$uid','$orderidmaker','Recharge $opname','$cashback','$amount','$status','$opname','-','$number','PaidMoney','$acnumber','$time','$date')"));				
echo "Recharge is ".$status;
}	
}else{
echo "Balance: ".$user['wallet'];
$payment="Failure";	
}	

}
if($source == "delete"){
$query = "DELETE FROM autopay WHERE id = '".$_POST['id']."'";
if ($result = mysqli_query($sp, $query)) {
echo "Successfully Deleted";
}
}



?>
