<?php
require_once "../include/config.php";

//http://localhost/society_mgt/api/bulletindelete.php?bulletin_id=1

if (isset($_REQUEST['bulletin_id']) && !empty($_REQUEST['bulletin_id'])) {
	
	$bulletin_id = $_REQUEST['bulletin_id'];

$query = getData('tbl_bulletin','*','bulletin_id');
if (!empty($query)) {
     
	$is_delete = updateDb("tbl_bulletin","is_delete = '1'","bulletin_id = '$bulletin_id'");
	if($is_delete)
		echo json(array('status'=>'1','message'=>"Bulletin deleted successfully."));
		else
		echo json(array('status'=>'0','message'=>"Bulletin not deleted."));
		exit;
	}else{
		echo json(array('status'=>'0','message'=>"Your input is not valid"));
		exit;
}
}