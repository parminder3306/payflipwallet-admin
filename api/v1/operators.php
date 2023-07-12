<?php
include_once 'db/db.php';
$sql=mysqli_query($sp,"SELECT * FROM operators where type='Prepaid' and status='Active'");
$sql2=mysqli_query($sp,"SELECT * FROM operators where type='Postpaid' and status='Active'");
$sql3=mysqli_query($sp,"SELECT * FROM operators where type='Datacard' and status='Active'");
$sql4=mysqli_query($sp,"SELECT * FROM operators where type='DTH' and status='Active'");
$sql5=mysqli_query($sp,"SELECT * FROM operators where type='Electricity' and status='Active'");
$sql6=mysqli_query($sp,"SELECT * FROM operators where type='Landline' and status='Active'");

while($row = mysqli_fetch_assoc($sql)){
$prepaid[] = $row;
}
while($row1 = mysqli_fetch_assoc($sql2)){
$postpaid[] = $row1;
}
while($row2 = mysqli_fetch_assoc($sql3)){
$datacard[] = $row2;
}
while($row3 = mysqli_fetch_assoc($sql4)){
$dth[] = $row3;
}
while($row4 = mysqli_fetch_assoc($sql5)){
$electricity[] = $row4;
}
while($row5 = mysqli_fetch_assoc($sql6)){
$landline[] = $row5;
}
 
$array= array('Prepaid' => $prepaid,'Postpaid' => $postpaid,'Datacard' => $datacard,'DTH' => $dth,'Electricity' => $electricity,'Landline' => $landline); 
echo  json_encode($array);

?>