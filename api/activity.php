<?php
require_once "../include/config.php";

//http://localhost/society_mgt/api/activity.php?activity=hsssssssssssskjkjksjxklksklkl&publish_date=2014-3-4&list_of_member=17,20

if (isset($_REQUEST['activity']) && !empty($_REQUEST['activity']) && isset($_REQUEST['publish_date']) && !empty($_REQUEST['publish_date']) && isset($_REQUEST['list_of_member']) && !empty($_REQUEST['list_of_member'])) {
	
	
	$insert = insertToDb("tbl_activity",$_REQUEST,$message='Inserted');
	if ($insert) {
		echo json(array('status'=>'1','message'=>'Activity added succesfully'));
		exit;
	}else
	{
		echo json(array('status'=>'0', 'message'=>'Activity not inserted'));
	    exit;
	}
}
else
{
	echo json(array('status'=>'0', 'message'=>'Your input is not valid'));
}
