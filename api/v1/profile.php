<?php
include_once 'db/db.php';
include_once 'codes.php';
$uid=(isset($_POST['uid']))?$sp->real_escape_string(trim($_POST['uid'])):'';
$name=(isset($_POST['name']))?$sp->real_escape_string(trim($_POST['name'])):'';
if (empty($_POST["name"]))  {
$error = true;
echo json_encode(array("msg" =>"Name is required"));
}
elseif (!preg_match("/^[a-zA-Z ]+$/",$name)) {
$error = true;
echo json_encode(array("msg" =>"Name must only contain letters and whitespace"));
}
elseif(strlen($name) < 3) {
$error = true;
echo json_encode(array("msg" =>"Name must be minimum of 3 characters"));
}
$sql = "select * from users where uid='".$uid."'";
$query = mysqli_query($sp,$sql);
$row = mysqli_fetch_array($query);
$uid=$row['uid']; 
if (!$error) {        
if(count($row)>=1){
$update="update users set name='$name' where uid='$uid'" ;
if(mysqli_query($sp, $update)){
echo json_encode(array("name" =>$name,"msg" =>"User Details Updated Successfully"));
}else{
echo json_encode(array("msg" =>"erorr profile updated"));
}
}                         
}	              
  ?>