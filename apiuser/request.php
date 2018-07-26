<?php
require_once "../include/config.php";

//http://localhost/society_mgt/apiuser/request.php?request_from_id=20&user_message=avfghgghg

if (isset($_REQUEST['request_from_id']) && !empty($_REQUEST['request_from_id']) && isset($_REQUEST['user_message']) && !empty($_REQUEST['user_message'])) {

	$request_from_id = $_REQUEST['request_from_id'];
	$user_message = $_REQUEST['user_message'];

	$arr = array( 'request_from_id' => $_REQUEST['request_from_id'],'user_message' => $_REQUEST['user_message'],'request_date'=>date('Y-m-d h:i:s'));

	$insert = insertToDb('tbl_process_request',$arr,$message= 'inserted');
	
	if ($insert) {
		echo json(array('status'=>'1', 'message'=>'Request sent'));
		exit;
	}else{
		echo json(array('status'=>'0', 'message'=>'Request not sent'));
		exit;
	}
	
}else{
	echo json(array('status'=>'0', 'message'=>'Your input is invalid'));
	exit;
}
