<?php 
require_once "../include/config.php";
 //localhost/society_mgt/api/image.php?user_id&profile_pic=17-180721105052-Alax3.jpg

  if(isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id']) && !empty($_FILES['image']['name']) && isset($_FILES['image']['name']))
  {
   $user_id = $_REQUEST['user_id'];
   $target_dir = '../images/'; // move file on targeed foleder
   $profile_pic = $user_id.'-'.date('ymdhis').'-'.$_FILES['image']['name'];
   $file_tmp = trim($_FILES['image']['tmp_name']);
   $response = array();
   if(move_uploaded_file($file_tmp, $target_dir.$profile_pic)){
    // save image in database table
    $query = updateDb("tbl_member", "profile_pic='$profile_pic'","user_id='$user_id'");
    if($query){
     
     echo json(array('status' => '1','message' => 'Your image has been updated successfully.',));
     exit;
    }
   }
   else{
    echo json(array('status' => '0','message' => 'Something went wrong while updating profile picture.'));
    exit;
   }
  }
  else
  {
   echo json(array('status' => '0','message' => 'Your input is not valid.'));
  }
   
 