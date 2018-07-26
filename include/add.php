 <?php
include 'config.php';
$task = $_POST['task'];

if($task=="userregistration")
{
	$password = $_POST['userpassword'];
	$confirmpassword = $_POST['confirm-password'];
	$email = $_POST['email'];
	$user_type = $_POST['user_type'];

	if($password!=$confirmpassword)
	{
		echo "<div class='alert alert-danger'>Password does not match</div>";
		exit;
	}

	$records = getData('tbl_users','*',"email = '$email' AND user_type = '$user_type'");
	if($records)
	{
		echo "<div class='alert alert-danger'>Email already exists</div>";
		exit;
	}

	unset($_POST['task']);
	unset($_POST['confirm-password']);
	$_POST['created_on'] = date('Y-m-d h:i:s');

	$_POST['userpassword'] = md5($_POST['userpassword']);
	$result = insertToDb('tbl_users',$_POST,$message='inserted');
	if($result['message']=="inserted")
	{
		if($user_type==2){
			$admininsert = insertToDb('tbl_admins',array('email'=>$_POST['email'],'password'=>$_POST['userpassword'],'user_type'=>1),$message='inserted');
			if($admininsert['message']=="inserted"){
				echo "success";
			}
			else
			{
				echo $admininsert['message'];
			}
		}else{
			echo "success";
		}
	}
	else
	{
		echo $result['message'];
	}

}

if ($task=="user-login")
{
	$email = $_POST['email'];
	$pwd = $_POST['pwd'];
	if(!empty($_POST['email']) && !empty($_POST['pwd']))
	{
		$model = getData('tbl_users','*',"email = '$email' AND userpassword = '".md5($_POST['pwd'])."'");
		
		if($model){
			$_SESSION['userid'] = $model[0]['uid'];
			$_SESSION['uniqueuid'] = $model[0]['uid'];
			echo 'success';
		}else{
			echo 'failed';
		}
	}
}

if ($task=="vendor_registration")
{
	
	if(!isArrayEmpty($_POST)) {
	    echo 'All fields are mandatory.';exit;
	}

	if(isset($_POST) && !empty($_POST))
	{
		$email = $_POST['address_email'];
		$records = getData('tbl_vendor_details','*',"address_email = '$email'");
		if($records)
		{
			echo "Email already exists";
			exit;
		}

		$_POST['working_hours'] = $_POST['workingHrsFrom'].' - '.$_POST['workingHrsTo'];
		unset($_POST['workingHrsFrom']);
		unset($_POST['workingHrsTo']);
		unset($_POST['task']);

		$_POST['vendor_code'] = generateVendorCode();

		$_POST['created_on'] = date('Y-m-d h:i:s');
		$result = insertToDb('tbl_vendor_details',$_POST,$message='inserted');
		if($result['message']=="inserted")
		{
			$body = "<p>Dear User,</p>
			<p>Thank You for registration. We are reviewing you details</p>
			<p>As soon as possible, we will send you your account login details.</p>
			<p>Stay in tuch.</p>
			<br><br>
			<p>
			Thanks & Regards<br>
			E-Pharmacy Team;
			</p>
			";
			sendmail($body,"E-Pharmacy : Registration Success",$email);
			echo "success";
		}
		else
		{
			echo $result['message'];
		}
	}
	else
	{
		echo false;
	}
}


function generateVendorCode()
{
	$alphabet = '011111222223333444445555566666777778888899999';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 4; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    $code = implode($pass); //turn the array into a string

    $data = getData('tbl_vendor_details','*',"vendor_code = '$code'");
	if($data)
	{
		generateVendorCode();
	}
	else
	{
		return $code;
	}

	
}

if ($task=="vieworder")
{
	$id = $_POST['oid'];
	$orderdetails = getData('tbl_order_details','*',"oid = '$id'");
	if($orderdetails)
	{
		foreach ($orderdetails as $key => $value) {
			echo "<tr>
			<td>".$value['item_name']."</td>
			<td>".$value['qty']."</td>
			<td>".$value['item_price']."</td>
			<td>".number_format($value['qty']*$value['item_price'],2)."</td>
			</tr>";
		}
	}
}

if($task=="updateuser")
{
	unset($_POST['task']);
	//echo "<pre>";print_r($_POST);
	foreach ($_POST as $key => $value) {
		$arr[] = "{$key} = '$value'";
	}

	foreach ($_POST as $k => $v) {
        if (!empty($v) || isset($v)) {
            $setData[] = $k . "= '" . mysqli_real_escape_string($condb, $v) . "'";
        }
    }
    $setData = implode(",", $setData);
    //print_r($setData);exit;
    $uid = $_SESSION['userid'];
    $update  = updateDB('tbl_users',$setData,"uid = '$uid'");
    if($update){
    	$_SESSION['userupdatealert'] = "<div class='alert alert-success'>Profile updated successfully.</div>";
    	echo "<script>location.href ='../profile.php'</script>";
    }
    else {
    	print_r($update);
    }
}

function isArrayEmpty($array) {
    foreach($array as $key => $val) {
        if ($val == ''){
        	//echo $key.$val;
            return false;
        }
    }
    return true;
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
    $mail->setFrom('connect@makonlinesolutions.com', 'E-Pharmacy');
    $mail->addReplyTo('connect@makonlinesolutions.com', 'E-Pharmacy');
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
?>

