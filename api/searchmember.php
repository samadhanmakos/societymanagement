<?php 

//http://localhost/society_mgt/api/searchmember.php?fullname=aditi
require_once "../include/config.php";
if (isset($_REQUEST['fullname']) && !empty($_REQUEST['fullname'])) {
 
 $name= $_REQUEST['fullname'];
 $records = getData("tbl_member","*", "first_name LIKE '%".$name."%' OR last_name LIKE '%".$name."%'");

 if (!empty($records)) {
  echo json(array('status'=>'1', 'member_name'=>$records));
 }
 else{
  echo json(array('status'=>'0','message'=>'Record not found'));
 }
}
else{
 $records = getData("tbl_member","*", "1");

 if (!empty($records)) {
  echo json(array('status'=>'1', 'member_name'=>$records));
 }
 else{
  echo json(array('status'=>'0','message'=>'Record not found'));
 }
}
