<?php 
require_once "../include/config.php";

//http://localhost/society_mgt/api/flatlist.php?building_id=1

if (isset($_REQUEST['building_id']) && !empty($_REQUEST['building_id'])) {
	$building_id= $_REQUEST['building_id'];

	$records = getData("tbl_flat","*","building_id='$building_id'");
	if (!empty($records)) {

		
			echo json(array('status'=>'1', 'flat_list'=>$records));
		}
		else{
			echo json(array('status'=>'0','message'=>'Record Not Found'));
		}

		  
	}
	else{
		 echo json(array('status'=>'0', 'message'=>'Your input is not valid'));
	}
