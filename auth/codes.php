<?php
date_default_timezone_set("Asia/Kolkata");

$error = false;
$payment="";
$date = date("d-m-Y");
$dateverify = date("Y-m-d");
$time = date("h:i A");

$refercodemaker = "PF".substr(number_format(time() * rand(),0,'',''),0,6);
$accesskeymaker = sha1(substr(number_format(time() * rand(),0,'',''),0,6));

$orderidmaker = substr(number_format(time() * rand(),0,'',''),0,10);
$orderidmaker1 = substr(number_format(time() * rand(),0,'',''),0,10);
$cashback_id = substr(number_format(time() * rand(),0,'',''),0,10);
?>