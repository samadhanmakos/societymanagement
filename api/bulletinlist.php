<?php
require_once "../include/config.php";

//http://localhost/society_mgt/api/bulletinlist.php

$records = getData("tbl_bulletin", "*", "1");
if (!empty($records)) {
	echo json(array('status'=>'1','bulletin list'=>$records));
}
else{
	echo json(array('status'=>'0','message'=>'No records found'));
}