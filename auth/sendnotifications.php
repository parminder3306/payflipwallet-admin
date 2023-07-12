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

if($source=="single"){
$result=mysqli_query($sp,"SELECT * FROM devices WHERE accesskey='".$_POST['accesskey']."'");
while($row = mysqli_fetch_assoc($result)){
	if(empty($_POST['banner'])){$image="null";}else{$image=$_POST['banner'];}
    $url = "https://fcm.googleapis.com/fcm/send";
    $serverKey = 'AIzaSyDw-QgJfOeH1SWWJvkaRtodaaq8f69vQZ0';
    $notification = array('image' =>$image,'title' =>$_POST['title'] , 'body' => $_POST['message'], 'sound' => 'default', 'badge' => '1', 'click_action' => $_POST['activity']);
    $arrayToSend = array('to' => $row["token"], 'notification' => $notification,'priority'=>'high');
    $json = json_encode($arrayToSend);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: key='. $serverKey;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    $response = curl_exec($ch);
    curl_close($ch);	
}
}

if($source=="all"){	
$result=mysqli_query($sp,"SELECT * FROM devices ");
while($row = mysqli_fetch_assoc($result)){
	if(empty($_POST['banner'])){$image="null";}else{$image=$_POST['banner'];}
    $url = "https://fcm.googleapis.com/fcm/send";
    $serverKey = 'AIzaSyDw-QgJfOeH1SWWJvkaRtodaaq8f69vQZ0';
    $notification = array('image' =>$image,'title' =>$_POST['title'] , 'body' => $_POST['message'], 'sound' => 'default', 'badge' => '1', 'click_action' => $_POST['activity']);
    $arrayToSend = array('to' => $row["token"], 'notification' => $notification,'priority'=>'high');
    $json = json_encode($arrayToSend);
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: key='. $serverKey;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    $response = curl_exec($ch);
    curl_close($ch);	
}	
}



?>
