<?php
require_once "../include/config.php";

//http://localhost/society_mgt/api/bulletin.php?activity=hsssssssssssskjkjksjxklksklkl&publish_date=2014-3-4

if (isset($_REQUEST['activity']) && !empty($_REQUEST['activity']) && isset($_REQUEST['publish_date']) && !empty($_REQUEST['publish_date'])) {
	
	$insert = insertToDb("tbl_bulletin",$_REQUEST,$message='Inserted');
	if ($insert) {
		echo json(array('status'=>'1','message'=>'Bulletin added succesfully'));
		exit;
	}else
	{
		echo json(array('status'=>'0', 'message'=>'Record not inserted'));
	    exit;
	}
}
else
{
	echo json(array('status'=>'0', 'message'=>'Your input is not valid'));
}
