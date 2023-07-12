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
$query .= "SELECT * FROM operators ";
if(!empty($_POST["searchPhrase"])){
$query .= 'WHERE (type LIKE "%'.$_POST["searchPhrase"].'%" ';
$query .= 'OR opid LIKE "%'.$_POST["searchPhrase"].'%" ';
$query .= 'OR opname LIKE "%'.$_POST["searchPhrase"].'%" ';
$query .= 'OR status LIKE "%'.$_POST["searchPhrase"].'%" ) ';
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

$query1 = "SELECT * FROM operators";
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
 $query = "SELECT * FROM operators WHERE id = '".$_POST["id"]."'";
 $result = mysqli_query($sp, $query);
 while($row = mysqli_fetch_assoc($result))
 {
  $output= $row;
 }
 echo json_encode($output);
}


if($source == "add"){
$opname=$_POST['opname'];	
$opid=$_POST['opid'];	
$oplogo=$_POST['oplogo'];	
$optype=$_POST['optype'];	
$status=$_POST['status'];

$add= "INSERT INTO operators (type,opid,opname,oplogo,status) VALUES ('$optype','$opid','$opname','$oplogo','$status')";
if($result = mysqli_query($sp, $add)){
echo "success";
}else{
echo "!error";
}		
}

if($source == "edit"){
$opname=$_POST['opname'];	
$opid=$_POST['opid'];	
$oplogo=$_POST['oplogo'];	
$optype=$_POST['optype'];	
$status=$_POST['status'];	
	
$update="update operators set type='$optype',opid='$opid',opname='$opname',oplogo='$oplogo',status='$status' where opname='$opname'" ;
if($result = mysqli_query($sp, $update)){
echo "success";
}else{
echo "!error";	
}	
}

if($source == "delete"){
$query = "DELETE FROM operators WHERE id = '".$_POST['id']."'";
if ($result = mysqli_query($sp, $query)) {
echo "Successfully Deleted";
}
}



?>
