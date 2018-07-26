<?php
require_once "../include/config.php";

//localhost/society_mgt/api/activitylist.php

$records = getData("tbl_activity", "*", "1");

if (!empty($records)) {
	//$list_of_member = getActivtyMemberList("");
	$result = array();
	for ($i=0; $i <count($records) ; $i++) { 
		$result[$i]['activity_id']=$records[$i]['activity_id'];
		$result[$i]['activity']=$records[$i]['activity'];
		$result[$i]['publish_date']=$records[$i]['publish_date'];
		$result[$i]['list_of_member']=$records[$i]['list_of_member'];
		$result[$i]['created_at']=$records[$i]['created_at'];
		$result[$i]['list_of_member_label']=getActivtyMemberList($records[$i]['list_of_member']);
		
	}
	echo json(array('status'=>'1','Activity_list'=>$result));
}
else{
	echo json(array('status'=>'0','message'=>'No records found'));
}