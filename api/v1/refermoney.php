<?php
include_once 'db/db.php';
$result=mysqli_query($sp,"SELECT * FROM referprogram");
$row = mysqli_fetch_assoc($result);
$count=$result->num_rows;
if($count==0){
echo "empty";
}else{
echo json_encode($row); 
}

?>