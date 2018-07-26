<?php
require_once "../include/config.php";

//http://localhost/society_mgt/api/activitydelete.php?activity_id=1

if (isset($_REQUEST['activity_id']) && !empty($_REQUEST['activity_id'])) {
	
	$activity_id = $_REQUEST['activity_id'];

$query = getData('tbl_activity','*','activity_id');
if (!empty($query)) {
     
	$is_delete = updateDb("tbl_activity","is_delete = '1'","activity_id = '$activity_id'");
	if($is_delete)
		echo json(array('status'=>'1','message'=>"Activity deleted successfully."));
		else
		echo json(array('status'=>'0','message'=>"Activity not deleted."));
		exit;
	}else{
		echo json(array('status'=>'0','message'=>"Your input is not valid"));
		exit;
}
}