<?php 
//Including top header file

include "includes/header.php";

if(isset($_REQUEST['formBrowse'])) //set sessions for browsing annomously
{
	
	if(isset($_REQUEST['agree']))
	{$_SESSION['BrowseOn']=1;
	}else{
		$_SESSION['ErrorBrowse']=1; //Agree on Terms and conditions
		}
	phpredirect("index.php");
}

function forgot($i, $email){
$qry = new query;
	//now validating the username and password
$sql="SELECT * FROM  sn_users WHERE email='".$email."'";


$result=mysql_query($sql);
$row=mysql_fetch_array($result);



//if username exists
if(mysql_num_rows($result)>0)
{
	//Header Information
	$to = 'iequals10@gmail.com';

$subject = '[SHEQL] Password Change Request';



$headers = 'From: SHEQL <iequals10@gmail.com>' . "\r\n";
$headers .= "Reply-To: ". $email . "\r\n";
$headers .= "CC: ccinfo@example.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$psw=rand(10000000,99999999);
$qry->queryInsert("UPDATE  sn_users SET `password` = '".md5($psw)."'  WHERE email='".$email."'");
	
	$data=$qry->querySelectSingle($sql);
//message

$message="<p>Dear ".$data["firstname"].",</p>
<p>";
if($i==1)
$message.="Your New Password is ".$psw;
else
$message.="Your User ID is ".$data["firstname"];

$message.="</p>
<p>Thank you!</p>
";

mail($email, $subject, $message, $headers);

$_SESSION['forget'.$i]=1;
phpredirect("pageSuccess.php");
}else{
	$_SESSION['errorEmail']=1;
	if($i==1)
	phpredirect("forgot.php");
	else
	phpredirect("forgot.php?forgot_user_id");
	
	}
	
	}

//for forgetpassword
if(isset($_POST['forgetPassword']))
{
	forgot(1,$_POST['emailID']);
}


//for forgetuserID
if(isset($_POST['forgetUserId']))
{
	forgot(0,$_POST['emailID']);
}


//deleting

if(isset($_REQUEST['deletePicture']))
{
  $qry_all_prod=$qry->querySelect("select * from sn_images where picture_id='".$_REQUEST['pic_id']."'");
			foreach($qry_all_prod as $pic)
			{
				unlink('uploads/'.$pic['file']);
				unlink('uploads/thumbs/'.$pic['file']);
echo $pic['file'];

			}
			
if($_SESSION['user_id']!=1)
$where= " AND user_id='".$_SESSION['user_id']."' ";
else
$where = "";
 $sql="DELETE FROM sn_pictures WHERE pic_id='".$_REQUEST['pic_id']."' $where";
  $qry->queryDelete($sql);
  
 $sql="DELETE FROM sn_images WHERE picture_id='".$_REQUEST['pic_id']."'";

 $qry->queryDelete($sql);
 phpredirect("records.php");

  
}

//Change Password//
if(isset($_POST["ChangePassword"]))
{
	
	$oldpassword = md5(trim(strip_tags($_POST['password'])));
	$password = md5(trim(strip_tags($_POST['pwd1'])));

	$queryData="Select *from sn_users where user_id='".$_SESSION['user_id']."' AND password='".$oldpassword."' ";

	$num = $qry->numRows($queryData); 
	
	if($num==0)
	{
		$_SESSION['MisMatchPsw']=1;
		echo"a";
	}
	else
	{

	$results=$qry->queryExecute("UPDATE `sn_users` set `password` ='".$password."' where user_id='".$_SESSION['user_id']."'");
		$_SESSION['ChangedPsw']=1;
	}
	
phpredirect("change_pswd.php");
	
	}
	

?>