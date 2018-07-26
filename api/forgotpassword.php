<?php 
require_once "../include/config.php";

//http://localhost/society_mgt/api/forgotpassword.php?email=aditi@makonlinesolutions.com&password=mDs0Eloa

if (isset($_REQUEST['email']) && !empty($_REQUEST['email'])) {
	# code...

$email = $_REQUEST['email'];
$to = $email;
$password= randomPassword();
$encrypt_password=md5($password);
$records= getData("tbl_member","*","email='$email'");

if(!empty($records)){
  $fullname = $records[0]['first_name'].' '.$records[0]['last_name'];


	$user_id = $records[0]['user_id'];
	$isUpdatePassword = updateDb("tbl_member", "password = '$encrypt_password'","user_id = '$user_id'");
	
}
else{
	$responce[]= array('status'=>"0",'message'=>"Email is not registered.");
	print(json_encode($responce));
	exit;
}

$message='
<html>
<head>
</head>
<body>
     <div style="padding:10px;border-style: solid;border-width: thin;border-color: black;">
         <h3>Society Managment</h3>
         <div style="padding:2%;border-style: solid;border-width: thin;border-color: black;line-height: 23px;">
         Hi '.$fullname.',<br><br><br>
		Name :'.$fullname.'<br>
		Email :'.$email.'<br>
                New Password :'.$password.'<br> 
                 <br><br> <br>
                Please retain for your records.<br>
See something unusual? Send us an email at info@adjinfotech.com<br>

         </div> 
        <div style="padding:2%;background-color:gray;border-style: solid;border-width: thin;border-color: black;">
               <div style="float:left">	Copyright 2018 © SocietyManagment. All Rights Reserved.</div>
                <div style="float:right">Prepared by ADJ INFOTECH</div>
         </div>
          
      </div>

</body>
</html>';

$subject = 'Password Reset from Society Managment.';
$name = "test.makos@gmail.com";
/*$headers = "From: " .$name. "\r\n";
$headers .= "Reply-To: ". strip_tags($_REQUEST['email']) . "\r\n";
$headers .= "CC: \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";*/


  if(!sendmail($message,$subject,$to))
   {
      
      	$responce[]= array('status'=>"0");
      	print(json_encode($responce));
       	exit;
    }
    else 
    {
        $responce[]=array('status'=>"1",'message'=>"email Sent.");
    	print(json_encode($responce));
        exit;
    }
}

?>