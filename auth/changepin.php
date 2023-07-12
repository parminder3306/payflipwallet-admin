<?php 
include_once 'session.php';
include_once 'codes.php';
		  $oldpin=(isset($_POST['oldpin']))?$sp->real_escape_string(trim($_POST['oldpin'])):'';
		  $newpin=(isset($_POST['newpin']))?$sp->real_escape_string(trim($_POST['newpin'])):'';
		        
		 $check="select * from admin where id='".$aid."' and pin='$oldpin'"; 
		 $check=$sp->query($check) or die ($sp->error);
		 $count=$check->num_rows;
		 
		  if(isset($_POST['submit'])){
		   if (empty($_POST["oldpin"]))  {
		$error = true;
		$msg="<div class='msgred'>Old PIN is required</div>";
	     }
	     elseif (strlen($_POST["oldpin"]) < 4)  {
		$error = true;
		$msg="<div class='msgred'>Old PIN is invaild</div>";
	    }
		 elseif (empty($_POST["newpin"]))  {
		$error = true;
		$msg="<div class='msgred'>New PIN is required</div>";
	     }
	     elseif (strlen($_POST["newpin"]) < 4)  {
		$error = true;
		$msg="<div class='msgred'>Old PIN is invaild</div>";
	    }     
		elseif ($oldpin == $newpin)  {
		$error = true;
		$msg="<div class='msgred'>Old and New Pin Same use Different</div>";
		}
		
if (!$error) {
if($count>0){
$update="update admin set pin='$newpin' where id='".$aid."'";
if(mysqli_query($sp, $update));
$msg="<div class='msggreen'>OTP PIN Changed Successfully!</div>";
header('refresh:2;/admin/auth/logout');
}else{
$msg="<div class='msgred'>Wrong old OTP PIN</div>";
}
}
}
?>