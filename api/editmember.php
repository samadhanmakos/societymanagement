<?php 
require_once "../include/config.php";
//http://localhost/society_mgt/api/editmember.php?fullname=Samadhan&mobile_no=9890604697&dob=2002-3-4&building_no=101&flat_no=1&user_id=2

if (isset($_REQUEST['first_name']) && !empty($_REQUEST['first_name']) && isset($_REQUEST['last_name'])&& !empty($_REQUEST['last_name']) && isset($_REQUEST['mobile_no'])&& !empty($_REQUEST['mobile_no'])  && isset($_REQUEST['dob'])&& !empty($_REQUEST['dob']) && isset($_REQUEST['building_no'])&& !empty($_REQUEST['building_no']) && isset($_REQUEST['flat_no'])&& !empty($_REQUEST['flat_no']) && isset($_REQUEST['user_id'])&& !empty($_REQUEST['user_id'])){

		$first_name = $_REQUEST['first_name'];
		$last_name = $_REQUEST['last_name'];
		$mobile_no = $_REQUEST['mobile_no'];
		$dob = $_REQUEST['dob'];
		$building_no = $_REQUEST['building_no'];
		$flat_no = $_REQUEST['flat_no'];
		$user_id = $_REQUEST['user_id'];

		$records = getData("tbl_member", "*","user_id='$user_id'");

		if (!empty($records)) {
			
			$query = updateDb("tbl_member","first_name='$first_name',last_name='$last_name',mobile_no='$mobile_no',dob='$dob',building_no='$building_no',flat_no='$flat_no'","user_id='$user_id'");

			if ($query) {
				echo json(array('status'=>'1','message'=>'Record Updated'));
				exit;
			}
			else{
			echo json(array('status'=>'0','message'=>'Record not Updated'));
			exit;
			}
		}
		else{
			echo json(array('status'=>'0','message'=>'Record not Found'));
			exit;
		}

}else{
		echo json(array('status'=>'0','message'=>'Invalid Input'));
	}