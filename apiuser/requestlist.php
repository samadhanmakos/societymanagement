<?php
require_once "../include/config.php";

$query = getData('tbl_process_request','*','1');
if($query){
	echo json(array('status'=>'1', 'requestlist'=>$query));
	exit;
}else{
	echo json(array('status'=>'0', 'message'=>'No record found'));
}
