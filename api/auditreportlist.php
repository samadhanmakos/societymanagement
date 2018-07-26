<?php 
require_once "../include/config.php";

//http://localhost/society_mgt/api/auditreportlist.php

$records = getData('tbl_audit', '*', '1');
if ($records) {
	echo json(array('status'=>'0','auditList'=>$records));
	exit;
}else
{
	echo json(array('status'=>'0','message'=>'No record(s) found'));
}