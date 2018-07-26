<?php 
	require_once "config.php";
	function insertToDb($table,$data,$message='inserted'){
       
		global $condb; $result = array(); $colArr = array();
		$sql = "INSERT INTO ".$table." SET ";
                
		foreach($data as $col => $val){
			if(!empty($val)) $colArr[] = $col." = '". mysqli_real_escape_string($condb,$val)."'";
		}
		$sql .= implode(',',$colArr);

		if(mysqli_query($condb,$sql)) $result['message'] = 'inserted';
		else $result['message'] = "Error: " . $sql . "<br>" . mysqli_error($condb);
		return $result;
	}
	
	function getlaastid(){
		global $condb; $result = array();
		$id = mysqli_insert_id($condb);
		return $id;
	}

	function getData($table,$data,$where=''){
		global $condb; $result = array();
		$sql = 'SELECT '.$data.' from '.$table;
		if(!empty($where)) $sql .= ' WHERE '.$where;
		//echo $sql ;exit;
		$resultset = mysqli_query($condb,$sql);
		if($resultset){
			if($resultset->num_rows>0){
				while($row = mysqli_fetch_assoc($resultset)){
					$res =array();
					foreach($row as $ind => $val){
						$res[$ind] = $val;
					}
					$result[] = $res;
				}
				//var_dump($result); exit;
				return $result;
			} 	
			else return array();
		}
		else{
			echo "Error: " . $sql . "<br>" . mysqli_error($condb); exit;
			return $result['message'] = "Error: " . $sql . "<br>" . mysqli_error($condb);
		} 
	}
	
	function deleteDb($table,$where,$message){
		global $condb; $result = array();
		$sql = "DELETE from ".$table." where ".$where;
		if(mysqli_query($condb,$sql)) $result['message'] = $message;
		else $result['message'] = "Error: " . $sql . "<br>" . mysqli_error($condb);
		return $result;
	}
	
	function updateDb($table,$setData,$where = ''){
		global $condb; $result = array();
		$sql = "UPDATE ".$table." SET  ".$setData;
		if(!empty($where)) $sql .= ' WHERE '.$where;
		//echo  $sql;exit;
		if(mysqli_query($condb,$sql)){
			 return true;
		}
		else{
			//return false;
			echo mysqli_error($condb); 
			die;
		} 
	}

	function dbQuery($sql){
//            echo $sql;
		global $condb; $result = array();
		$resultset = mysqli_query($condb,$sql);
		if($resultset){
			if($resultset->num_rows>0){
				while($row = mysqli_fetch_assoc($resultset)){
					$res =array();
					foreach($row as $ind => $val){
						$res[$ind] = $val;
					}
					$result[] = $res;
				}
				//var_dump($result); exit;
				return $result;
			} 	
			else return array();
		}
		else{
			echo "Error: " . $sql . "<br>" . mysqli_error($condb); exit;
			return $result['message'] = "Error: " . $sql . "<br>" . mysqli_error($condb);
		} 
	}
        
        function getcountrylist(){
    $sql1 = "Select * from countries";
    $result1 = dbQuery($sql1);
     foreach ($result1 as $row) {
            $id = $row['id'];
            $country_name = $row['name'];
            
           echo ' <option value="'.$country_name.'">'.$country_name.'</option>';
     }
    
}
     
function json($array)
{
	return json_encode(array($array));
}

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
function sendmail($body,$subject,$to)
{
	require 'phpmailer/class.phpmailer.php';
	$mail = new PHPMailer;
	$mail->IsSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'mail.makonlinesolutions.com';//'smtp.gmail.com';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPAuth = true;
    $mail->Username = "connect@makonlinesolutions.com";//"makostest123@gmail.com";
    $mail->Password = "makos*005";

    $mail->IsHTML(true);
    $mail->SingleTo = true; 
    $mail->setFrom('connect@makonlinesolutions.com', 'Society Mangment');
    $mail->addReplyTo('connect@makonlinesolutions.com', 'Society Mangment');
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->msgHTML($body);
    if (!$mail->send()) {
        return false;//echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        return true; //echo "Message sent!";
    }

	return true;
}
function getActivtyMemberList($ids){
 $result = array();
 $explode = explode(',',$ids);
 for($i=0;$i<count($explode);$i++){
  $model = getData("tbl_member","*","user_id='$explode[$i]'");
  $result[] = $model[0]['first_name'].' '.$model[0]['last_name'];
 }
 return implode(',',$result);
}
?>
