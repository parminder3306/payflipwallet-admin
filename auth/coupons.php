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
$query .= "SELECT * FROM coupons ";
if(!empty($_POST["searchPhrase"])){
$query .= 'WHERE (status LIKE "%'.$_POST["searchPhrase"].'%" ';
$query .= 'OR promocode LIKE "%'.$_POST["searchPhrase"].'%" ) ';
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

$query1 = "SELECT * FROM coupons";
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
$promocode=$_POST['promocode'];
$percent=$_POST['percent'];
$apply_min=$_POST['apply_min'];
$apply_max=$_POST['apply_max'];
$apply_uses=$_POST['apply_uses'];
$users=$_POST['users'];
$apply=$_POST['apply'];
$openable=$_POST['openable'];
$validity=$_POST['validity'];

if (empty($promocode))  {
$error = true;
echo "Please Enter promocode Code";
}
elseif (empty($percent))  {
$error = true;
echo "Please Enter Discount";
}
elseif (empty($apply_min))  {
$error = true;
echo "Please Enter Min Amount";
}
elseif (empty($apply_max))  {
$error = true;
echo "Please Enter Max Amount";
}
elseif (empty($apply_uses))  {
$error = true;
echo "Please Enter Total Redeem";
}
elseif (empty($users))  {
$error = true;
echo "Please Enter Total Users";
}
elseif (empty($apply))  {
$error = true;
echo "Please Select apply";
}
elseif (empty($openable))  {
$error = true;
echo "Please Select Openable";
}
elseif (empty($validity))  {
$error = true;
echo "Please Enter Validity Date";
}
if(!$error){
$insert="insert into coupons(promocode,percent,apply_min,apply_max,apply_uses,redeem,users,apply,status,openable,validity)VALUES('".strtoupper($promocode)."','$percent','$apply_min','$apply_max','$apply_uses','0','$users','$apply','Active','$openable','$validity')";
if(mysqli_query($sp, $insert)){	
echo "success";
}else{
echo "error";
}
}
}

if($source == "details" && isset($_POST["id"])){
 $query = "SELECT * FROM coupons WHERE id = '".$_POST["id"]."'";
 $result = mysqli_query($sp, $query);
 while($row = mysqli_fetch_assoc($result))
 {
  $output= $row;
 }
 echo json_encode($output);
}

if($source == "edit"){
$id=$_POST['id'];
$promocode=$_POST['promocode'];
$percent=$_POST['percent'];
$apply_min=$_POST['apply_min'];
$apply_max=$_POST['apply_max'];
$apply_uses=$_POST['apply_uses'];
$users=$_POST['users'];
$apply=$_POST['apply'];
$openable=$_POST['openable'];
$validity=$_POST['validity'];
$update="update coupons set promocode='$promocode',percent='$percent',apply_min='$apply_min',apply_max='$apply_max',apply_uses='$apply_uses',users='$users',apply='$apply',openable='$openable',validity='$validity' where id='$id'";
if($result = mysqli_query($sp, $update)){
echo "success";
}else{
echo "!error";	
}	
}

if($source == "delete"){
$query = "DELETE FROM coupons WHERE id = '".$_POST['id']."'";
if ($result = mysqli_query($sp, $query)) {
echo "Successfully Deleted";
}
}



?>
