<?php
include_once("db.php");
$curl_error="";
$ch = curl_init(); 
curl_setopt ($ch, CURLOPT_URL,"https://www.pay2all.in/web-api/get-balance?api_token=9t9BGCs1OEY8ysAQSFLXIfVB8nMJlXPCyaR81B0kGRav5PvVo7J3E28bIw94");
curl_setopt ($ch, CURLOPT_HEADER, 0);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT,131);
$file_contents = curl_exec($ch);
$curl_error = curl_errno($ch);
curl_close($ch);

if($curl_error)
{
$balance='0';
}else{
$jsondata = json_decode($file_contents, true);
$balance=$jsondata['balance'];
}
$users=mysqli_query($sp,"select * from users")->num_rows;
$coupons=mysqli_query($sp,"select * from coupons")->num_rows;
$refunds=mysqli_query($sp,"select * from orders where type='RefundMoney' ")->num_rows;
$success=mysqli_query($sp,"select * from orders where status='Success' ")->num_rows;
$pending=mysqli_query($sp,"select * from orders where status='Processing' ")->num_rows;
$failure=mysqli_query($sp,"select * from orders where status='Failure' ")->num_rows;
$offers="0";
$operators=mysqli_query($sp,"select * from operators ")->num_rows;
$api=mysqli_query($sp,"select * from setup where provider='Pay2all' ")->num_rows;
$gateway=mysqli_query($sp,"select * from setup where provider='Payumoney' ")->num_rows;
$json=array("balance"=>$balance,"users"=>$users,"coupons"=>$coupons,"refunds"=>$refunds,"success"=>$success,"pending"=>$pending,"failure"=>$failure,"offers"=>$offers,"operators"=>$operators,"api"=>$api,"gateway"=>$gateway);
echo json_encode($json);
?>