<?php
require_once "../include/config.php";

//http://localhost/society_mgt/api/buildinglist.php

$records = getData("tbl_building", '*', "1");

if (!empty($records)) {
	echo json(array('status'=> '1','buildingList'=>$records));
	exit;
}
else{
	echo json(array('status'=> '0','message'=>'record not found'));
	exit;
}
?>