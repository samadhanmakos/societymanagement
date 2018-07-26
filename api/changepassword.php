<?php 
require_once "../include/config.php";

//http://localhost/society_mgt/api/changepassword.php?user_id=17&password=TznINQeT&new_password=12345

if (isset($_REQUEST['password']) && !empty($_REQUEST['password']) && isset($_REQUEST['new_password']) && !empty($_REQUEST['new_password']) && isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id'])) {

		$password = md5($_REQUEST['password']);
		$new_password = md5($_REQUEST['new_password']);
		$user_id = $_REQUEST['user_id'];

		$records = getData("tbl_member","*","password='$password' AND user_id='$user_id'");
		if (!empty($records)) {

			$query = updateDb("tbl_member","password='$new_password'","user_id='$user_id'");
			if ($query) {
				echo json(array('status'=>'1','message'=>'Password successfully changed'));
				exit;
			}
		}
		else{
			echo json(array('status'=>'0','message'=>'Incorrect current password'));
			exit;
		}
}else{
	echo json(array('status'=>'0','message'=>'Invalid input'));
}