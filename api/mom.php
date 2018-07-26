<?php 
require_once "../include/config.php";

 //localhost/society_mgt/api/mom.php?title=mom1&attachment=17-180721105052-Alax3

  if(isset($_REQUEST['title']) && !empty($_REQUEST['title']) && !empty($_FILES['attachment']['name']) && isset($_FILES['attachment']['name'])) {

  	$title = $_REQUEST['title'];
  	$target_dir = '../uploads/';
  	$attachment = date('ymdhis').'-'.$_FILES['attachment']['name'];
	//$attachment = $target_dir . basename($_FILES["attachment"]["name"]);
	$file_tmp = trim($_FILES['attachment']['tmp_name']);
    $response = array();


  	
  	if(move_uploaded_file($file_tmp, $target_dir.$attachment)){
  		$arr = array('title'=>$_REQUEST['title'],'attachment'=>$attachment,'created_on'=>date('Y-m-d h:i:s'));
  		$insert = insertToDb("tbl_mom", $arr,$message='Inserted');
    if($insert){
		echo json(array('status'=>'1','message'=>'MOM report uploaded succesfully'));
		exit;
	}else
	{
		echo json(array('status'=>'0', 'message'=>'Report not inserted'));
	    exit;
	}
}
}
else
{
	echo json(array('status'=>'0', 'message'=>'Your input is not valid'));
}