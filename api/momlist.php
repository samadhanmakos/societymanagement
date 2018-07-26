<?php 
require_once "../include/config.php";

//http://localhost/society_mgt/api/momlist.php

$records = getData('tbl_mom', '*', '1');
if ($records) {
	echo json(array('status'=>'0','momList'=>$records));
	exit;
}else
{
	echo json(array('status'=>'0','message'=>'No record(s) found'));
}