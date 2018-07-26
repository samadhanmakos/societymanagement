<?php
//error_reporting(0);
define("CURRENCY", "₹ ");
date_default_timezone_set('Asia/Calcutta');
session_start();

$condb = mysqli_connect("localhost","root","","db_society");

// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

include('dbFunctions.php');
/*function generateOrderNo()
{
    $orderno = date('Ymd').rand(101,999);
    $records = getData('tbl_order','*',"orderno = '$orderno'");
    if($records){ generateOrderNo(); }else{ return $orderno; }
    
}*/
?>