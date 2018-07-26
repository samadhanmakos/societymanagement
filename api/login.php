<?php 
require_once "../include/config.php";

// http://localhost/society_mgt/api/login.php?email=aditichavan1111@gmail.com&password=R2zhGagP&token=197dsfsdf&user_type=1

// step 1 validate input parameter isset or not equal to empty
if (isset($_REQUEST['email']) && !empty($_REQUEST['email']) && isset($_REQUEST['password']) && !empty($_REQUEST['password']) && isset($_REQUEST['token']) && !empty($_REQUEST['token']) && isset($_REQUEST['user_type']) && !empty($_REQUEST['user_type'])) 
{
	// step 2 selct where email and password
    $email = $_REQUEST['email'];
    $password = md5($_REQUEST['password']);
    $token = $_REQUEST['token'];

    if($_REQUEST['user_type']==1)
    $records = getData("tbl_member",'*',"email = '$email' AND password = '$password'");
    else if($_REQUEST['user_type']==2)
	$records = getData("tbl_member",'*',"email = '$email' AND password = '$password' AND flat_status='1'");

	if(!empty($records)){
		$user_id = $records[0]['user_id'];
		$isUpdateToken = updateDb("tbl_member","token = '$token'","user_id = '$user_id'");
		if($isUpdateToken)
		echo json(array('status'=>'1','message'=>"Login success."));
		else
		echo json(array('status'=>'1','message'=>"Token is not updated."));
		exit;
	}else{
		echo json(array('status'=>'0','message'=>"incorrect email and password"));
		exit;
	}
	// step 3 if records found
	//... update token on respective userid
	//.. print success json response 
	//else
	//print email and password is incorrect
}
else
{
	echo json(array('status'=>'0','message'=>"Your input is not valid."));
		exit;
}
