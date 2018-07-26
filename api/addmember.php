<?php 
require_once "../include/config.php";

//http://localhost/society_mgt/api/addmember.php?first_name=Samadhan&last_name=nirali&mobile_no=9890604697&dob=2002-3-4&building_no=101&flat_no=1&email=aditichavan1111@gmail.com&join_date=2016-3-4&flat_status=1&user_type=1

if (isset($_REQUEST['first_name'])&& !empty($_REQUEST['first_name']) && isset($_REQUEST['last_name'])&& !empty($_REQUEST['last_name']) && isset($_REQUEST['email'])&& !empty($_REQUEST['email']) && isset($_REQUEST['mobile_no'])&& !empty($_REQUEST['mobile_no']) && isset($_REQUEST['dob'])&& !empty($_REQUEST['dob']) && isset($_REQUEST['building_no'])&& !empty($_REQUEST['building_no']) && isset($_REQUEST['flat_no'])&& !empty($_REQUEST['flat_no']) && isset($_REQUEST['join_date'])&& !empty($_REQUEST['join_date']) && isset($_REQUEST['flat_status'])&& !empty($_REQUEST['flat_status']) && isset($_REQUEST['user_type'])&& !empty($_REQUEST['user_type'])){

	
	$fullname = $_REQUEST['first_name'].' '.$_REQUEST['last_name'];
	$email = $_REQUEST['email'];
	$to = $email;
	$password= randomPassword();
	$encrypt_password=md5($password);
	$records= getData("tbl_member","*","email='$email'");
	if ($records) {
		echo json(array('status'=>'0', 'message'=>'Email already exist.'));
		exit;
	}
	/*$insertdata = array('fullname'=>$_REQUEST['fullname'],'email'=>$_REQUEST['email'],'mobile_no'=>$_REQUEST['mobile_no'],'dob'=>$_REQUEST['dob'],'building_no'=>$_REQUEST['building_no'],'flat_no'=>$_REQUEST['flat_no'],'join_date'=>$_REQUEST['join_date'],'created_on'=>date('Y-m-d'));*/
	

	$insert = insertToDb('tbl_member',$_REQUEST,$message='Inserted');
		if ($insert) {
			$user_id =getlaastid();
			$message='
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;    
}
</style>
</head>
<body>
     <div style="padding:10px;border-style: solid;border-width: thin;border-color: black;">
         <h3>Society Managment</h3>
         <div style="padding:2%;border-style: solid;border-width: thin;border-color: black;line-height: 23px;">
         		Hi '.$fullname.',<br><br><br>
		      Thanks for booking your flat in {society name}, Your mobile app and web login credentials are bellow:<br><br>
		      <table style="width:60%">
  				<tr>
                <th>User Type </th>
                <td> User</td></tr>
               <tr>
                <th>Email </th>
                <td>'.$email.'</td></tr>
               <tr>
              	<th>Password </th>
              	<td>'.$password.'</td>
               </tr>
               </table> 
		            
               	For mobile app go to bellow link to install our mobile app:<br>
				{playstore link for download app}<br><br>

				Thanks & Regards,<br>
				{Manager Name}<br>
				{Society Name}<br>
				{society Address}<br>
				{Society Contact No}<br>
               
                 <br><br> <br>
                
				See something unusual? Send us an email at info@adjinfotech.com<br>

         </div> 
        <div style="padding:2%;background-color:gray;border-style: solid;border-width: thin;border-color: black;">
               <div style="float:left">	Copyright 2018 © SocietyManagment. All Rights Reserved.</div>
                <div style="float:right">Prepared by ADJ INFOTECH</div>
         </div>
          
      </div>

</body>
</html>';

$subject = 'Email verification.';
$name = "test.makos@gmail.com";
				if(!sendmail($message,$subject,$to))
			   {
			      
			      	$responce[]= array('status'=>"0");
			      	print(json_encode($responce));
			       	exit;
			    }
			    $isUpdatePassword = updateDb("tbl_member","password = '$encrypt_password'","user_id = '$user_id'");
				echo json(array('status'=>'1','message'=>'Member added successfully'));
				exit;
			}
			else{
				echo json(array('status'=>'0','message'=>'Record not Inserted'));
				exit;
			}
}
else
{
	echo json(array('status'=>0, 'message'=>'Your input is not valid'));
}




