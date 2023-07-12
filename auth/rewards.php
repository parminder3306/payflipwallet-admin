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
$query .= "SELECT * FROM rewards ";
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

$query1 = "SELECT * FROM rewards";
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
 $query = "SELECT * FROM rewards WHERE id = '".$_POST["id"]."'";
 $result = mysqli_query($sp, $query);
 while($row = mysqli_fetch_assoc($result))
 {
  $output= $row;
 }
 echo json_encode($output);
}

if($source == "edit"){
$id=$_POST['id'];
$cashback=$_POST['cashback'];
$openable=$_POST['openable'];
$update="update rewards set cashback='$cashback',openable='$openable' where id='$id'";
if($result = mysqli_query($sp, $update)){
echo "success";
}else{
echo "!error";	
}	
}

if($source == "delete"){
$query = "DELETE FROM rewards WHERE id = '".$_POST['id']."'";
if ($result = mysqli_query($sp, $query)) {
echo "Successfully Deleted";
}
}



?>
