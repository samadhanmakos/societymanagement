<?php 
require_once "../include/config.php";

if (isset($_REQUEST['email']) && !empty($_REQUEST['email']) && isset($_REQUEST['fullname']) && !empty($_REQUEST['fullname'])) {
	# code...

$email = $_REQUEST['email'];
$to = $email;
$password= randomPassword();

$records= getData("tbl_member","*","email='$email'");

if(!empty($records)){
	$fullname = $records[0]['fullname'];

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
         <img src="www.fooditter.com/live/admin/master/WS/logo2.png" alt="Fooditter" height="42" width="42">
         <div style="padding:2%;border-style: solid;border-width: thin;border-color: black;line-height: 23px;">
         Hi '.$fullname.',<br><br><br>
		Name :'.$fullname.'<br>
		Email :'.$email.'<br>
                Change Password Link :'.$password.'<br> 
                 <br><br> <br>
                Please retain for your records.<br>
See something unusual? Send us an email at info@magnetoitsolutions.com and cite the Invoice Number.<br>
Fooditter respects your privacy.Information regarding your personal information can be viewed at http://www.magnetoitsolutions.com/legal/privacy/
         </div> 
        <div style="padding:2%;background-color:gray;border-style: solid;border-width: thin;border-color: black;">
               <div style="float:left">	Copyright 2015 © Fooditter. All Rights Reserved.</div>
                <div style="float:right">Prepared by magnetoitsolutions Pvt Ltd</div>
         </div>
          
      </div>

</body>
</html>';

$subject = 'Password Reset from Fooditter.';
$name = "PasswordReset@fooditter.com";
$headers = "From: " .$name. "\r\n";
$headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
$headers .= "CC: \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

mail($to, $subject, $message, $headers);
  if(!mail($to, $subject, $message, $headers))
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