<?php
include_once 'db/db.php';
$result=mysqli_query($sp,"SELECT * FROM offers");
$count=$result->num_rows;
if($count==0){
echo "empty";
}else{
while($row = mysqli_fetch_assoc($result)){
$offers[]=$row;
} 
echo json_encode($offers);
}
?>