<?php 
require_once "../include/config.php";

//http://localhost/society_mgt/api/changestatus.php?user_id=17

if (isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id'])) {
	
	$user_id=$_REQUEST['user_id'];
	$records = getData("tbl_member", "*", "user_id='$user_id'");

	if (!empty($records)) {
		//$query = getData("tbl_member", "flat_status= '$flat_status'", "user_id='$user_id'");
		$updateStatus = updateDb("tbl_member", "flat_status='0'", "user_id='$user_id'");

		if ($updateStatus) {
			$flat_no = $records[0]['flat_no'];
			$updateFlat = updateDb("tbl_flat", "status='0'","flat_no='$flat_no'");
			echo json(array('status'=>'1', 'message'=>'Flat status updated succesfully'));
			exit;
		}
		else{
			echo json(array('status'=>'0', 'message'=>'Record not updated'));
		    exit;
		}
	}
	else{
		echo json(array('status'=>'0', 'message'=>'User not found'));
		exit;
	}
}
else{
	echo json(array('status'=>'0', 'message'=>'User not found'));
	exit;
}

/*if userexists
 get float no
 update member status
 if status updated
  change status of flat no 
  if flat no status changed
  show success
  else
  show failure
 else
 show failure
else
user not found*/