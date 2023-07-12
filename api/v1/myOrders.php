<?php
include_once 'db/db.php';
$uid=(isset($_POST['uid']))?$sp->real_escape_string(trim($_POST['uid'])):'';
if($uid){
$result=mysqli_query($sp,"SELECT * FROM orders WHERE uid='$uid'  ORDER BY id DESC LIMIT 0,50");
$count=$result->num_rows;
if($count==0){
echo "empty";
}else{
while($row = mysqli_fetch_assoc($result)){
$orders[]= $row;
}
echo json_encode($orders); 
}
}

?>