<?php 
include_once 'db/db.php';
$title=(isset($_GET['title']))?$sp->real_escape_string(trim($_GET['title'])):'';
$query = "select * from offers where title='".$title."'";
$result = mysqli_query($sp,$query);
$row=mysqli_fetch_assoc($result);
$count=$result->num_rows;
if($count==1){
if($row["activity"]=="Recharge"){
   $btn="Recharge"; 
   $onclick="Recharge();";
}
elseif($row["activity"]=="DTH"){
  $btn="Recharge"; 
  $onclick="Dth();";
}
elseif($row["activity"]=="Electricity"){
   $btn="Pay Bill";   
   $onclick="Electricity();";
}
elseif($row["activity"]=="Landline"){
   $btn="Pay Bill";  
    $onclick="Landline();";
}
elseif($row["activity"]=="Voucher"){
   $btn="Redeem";   
   $onclick="Voucher();";
}
elseif($row["activity"]=="Sendmoney"){
   $btn="SendMoney";  
   $onclick="Sendmoney();";
}
elseif($row["activity"]=="Webview"){
   $btn="Open Deal";
   $onclick="OpenUrl('".$row["dealurl"]."');";
}

?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width = device-width">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="robots" content="index, follow">
<style>
body {
    margin: 0;
    font-family: sans-serif;
    font-size: 12px;
    line-height: 1.42857143;
    letter-spacing: 0.2px;
    color: #7a7a79;
    font-weight: 700;
    background-color: #f7f7f7;
}
.mybtn{
	 padding: 15px;
    width: 100%;
    text-align: center;
    text-transform: uppercase;
    font-size: 11px;
    background-color: #0578d0;
    color: white;
    position: fixed;
    border: none;
	font-weight: 600;
    bottom: 0;
}
p{
	margin-bottom: 20px;
}
</style>
</head>
<body>
<div style="background:#fff;height:130px;">
<center>
<img style="width:250px;" src="<?php if(isset($row["logourl"])){echo $row["logourl"];}?>"/>
</center></div>
<div style="border: 1px solid #ddd;margin:10px 5px 0px;height:auto;border-radius:5px;background:#fff;">
<div style="font-weight:400;color:#666;margin:15px 15px 20px;">
<h3 style="font-weight:500;margin-bottom: 20px;">Offers Details :</h3>
<p>* <?php if(isset($row["details"])){echo $row["details"];}?>.</p>
<?php if($row["promocode"]!==""){
echo "<p>*  Coupon code is : <span style='color:#ff8c00;font-weight:bold;border:1px dashed #ff8c00;padding:3px;'>".$row["promocode"]."</span></p>";}
elseif($row["scratchcard"]=="Yes"){echo "<p>*  Scratch Card & win</p>";}?>
<p>* Offer valid once during the offer period.</p>
<p>* Offer vaild from <?php if(isset($row["date"])){echo $row["date"];}?>.</p>
<p>* Cashback will be be directly credited to your PayflipWallet within 72 hours</p>
</div>
</div>
<?php
if($row["termconditions"]){
echo '<div style="border: 1px solid #ddd;margin:10px 5px 80px;height:auto;border-radius:5px;background:#fff;">
<div style="font-weight:400;color:#666;margin:15px 15px 20px;">
<h3 style="font-weight:500;margin-bottom: 20px;">TERMS & CONDITIONS</h3>';

$string = explode(".",$row["termconditions"]);
foreach($string as $x) {
echo "<p>* ".$x.".</p>";
}
echo'</div></div>';
}
?>
<button type="button" onclick="DealDetails.<?php if(isset($onclick)){echo $onclick;}?>;DealDetails.soundclick()" class="mybtn"><?php if(isset($btn)){echo $btn;}?></button>
</body></html>
<?php } ?>