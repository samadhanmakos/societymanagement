<?php
require_once "../include/config.php";

//http://localhost/society_mgt/api/requestlist.php

$records = getData("tbl_process_request", '*', "1");

if (!empty($records)) {
	echo json(array('status'=> '1','requestlist'=>$records));
	exit;
}
else{
	echo json(array('status'=> '0','message'=>'record not found'));
	exit;
}
?>