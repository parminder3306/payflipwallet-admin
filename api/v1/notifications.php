<?php
$query=false;
include_once 'db/db.php';
$accesskey=(isset($_POST['accesskey']))?$sp->real_escape_string(trim($_POST['accesskey'])):'';
$senderid=(isset($_POST['senderid']))?$sp->real_escape_string(trim($_POST['senderid'])):'';
if($accesskey){
$result = mysqli_query($sp,"SELECT * FROM notifications where  status='Processing' and accesskey='$accesskey'");
if($result->num_rows==0){
echo "empty";
}else{
while($row = mysqli_fetch_assoc($result)){
$notifications[]= $row;
}
echo json_encode($notifications); 
}	
}	

if($senderid){
if(mysqli_query($sp,"DELETE FROM notifications WHERE senderid='$senderid'")){
echo "Success";
}	
}
?>