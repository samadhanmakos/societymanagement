<?php 
require_once "../include/config.php";
//http://localhost/society_mgt/api/replymember.php?request_id=1&response_message=hello

if (isset($_REQUEST['request_id'])&& !empty($_REQUEST['request_id'])  && isset($_REQUEST['response_message'])&& !empty($_REQUEST['response_message'])) {

	$request_id= $_REQUEST['request_id'];
	$response_message= $_REQUEST['response_message'];

	$records= getData('tbl_process_request','*',"request_id='$request_id'");
	if (!empty($records)) {
		
		$query = updateDb("tbl_process_request","response_message='$response_message',status='0'","request_id='$request_id'");
			if ($query) {
				echo json(array('status'=>'1','message'=>'Response sent succesfully'));
				exit;
			}else{
			echo json(array('status'=>'0','message'=>'Response not sent'));
			exit;
			}
		}else{
			echo json(array('status'=>'0','message'=>'Record not Found'));
			exit;
		}

}else{
		echo json(array('status'=>'0','message'=>'Invalid Input'));
	 }
	