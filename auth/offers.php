<?php
include("db.php");
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
$query .= "SELECT * FROM offers ";
if(!empty($_POST["searchPhrase"])){
$query .= 'WHERE (title LIKE "%'.$_POST["searchPhrase"].'%" ';
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
 $query .= 'ORDER BY title';
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

$query1 = "SELECT * FROM offers";
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
$logourl=$_POST['logourl'];
$dealurl=$_POST['dealurl'];
$title=$_POST['title'];
$details=$_POST['details'];
$scratchcard=$_POST['scratchcard'];
$promocode=$_POST['promocode'];
$date=$_POST['date'];
$activity=$_POST['activity'];
$termconditions=$_POST['termconditions'];

$insert="insert into offers(logourl,dealurl,title,details,scratchcard,promocode,date,activity,termconditions)VALUES('$logourl','$dealurl','$title','$details','$scratchcard','".strtoupper($promocode)."','$date','$activity','$termconditions')";
if(mysqli_query($sp, $insert)){	
echo "success";
}else{
echo "error";
}
}

if($source == "details" && isset($_POST["id"])){
 $query = "SELECT * FROM offers WHERE id = '".$_POST["id"]."'";
 $result = mysqli_query($sp, $query);
 while($row = mysqli_fetch_assoc($result))
 {
  $output= $row;
 }
 echo json_encode($output);
}

if($source == "edit"){
$logourl=$_POST['logourl'];
$dealurl=$_POST['dealurl'];
$title=$_POST['title'];
$details=$_POST['details'];
$scratchcard=$_POST['scratchcard'];
$promocode=$_POST['promocode'];
$date=$_POST['date'];
$activity=$_POST['activity'];
$termconditions=$_POST['termconditions'];
$update="update offers set logourl='$logourl',dealurl='$dealurl',title='$title',details='$details',scratchcard='$scratchcard',promocode='$promocode',date='$date',activity='$activity',termconditions='$termconditions' where id='".$_POST['id']."'";
if($result = mysqli_query($sp, $update)){
echo "success";
}else{
echo "!error";	
}	
}
if($source == "delete"){
$query = "DELETE FROM offers WHERE id = '".$_POST['id']."'";
if ($result = mysqli_query($sp, $query)) {
echo "Successfully Deleted";
}
}

?>
