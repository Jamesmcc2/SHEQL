<?php 
//Including top header file

include "includes/header.php";



function quickUpdate($table, $data, $ID)
	{
		$query = "UPDATE `".$table."` set ";
		$i = count($data);
		
		echo $i;
		for ($k=0; $k<$i; $k++)
		{
			if($data[$k]=="password") 
				$upData=md5(sbGet($data[$k]));
			else
				$upData=sbGet($data[$k]);
			
		$query.= "`".$data[$k]."` ='".$upData."' ";
		

		
		if($k<($i-1))
		{	$query .=", ";
		}
	}
	$qry=new query;
	$query .=" where ".$ID[0]." = '".$ID[1]."';";
	

	$results=$qry->queryExecute($query);

}
	
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
$sql="SELECT * FROM  sn_users WHERE email='".$email."' AND status=1";


$result=mysql_query($sql);
$row=mysql_fetch_array($result);



//if username exists
if(mysql_num_rows($result)>0)
{
	//Header Information
	$to = 'admin@SHEQL.org';

$subject = 'SHEQL: Website Change Request';

$headers = "From: admin@SHEQL.org \r\n";
$headers .= "Reply-To: ". $email . "\r\n";
$headers .= "CC: iequals10@gmail.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$psw=rand(10000000,99999999);
$qry->queryInsert("UPDATE  sn_users SET `password` = '".md5($psw)."'  WHERE email='".$email."' AND status=1");
	
	$data=$qry->querySelectSingle($sql);
//message

$message="<p>Dear ".$data["firstname"]."</p>
<p>";
if($i==1)
$message.="Your New Password is ".$psw;
else
$message.="Your User ID is ".$data["firstname"];

$message.="</p>
<p>Thank you!</p>
";

mail($to, $subject, $message, $headers);

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
if(isset($_REQUEST['forgetPassword']))
{
	forgot(1,sbGet('emailID'));
}


//for forgetuserID
if(isset($_REQUEST['forgetUserId']))
{
	forgot(0,sbGet('emailID'));
}


//deleting

if(isset($_REQUEST['deletePicture']))
{
  $qry_all_prod=$qry->querySelect("select * from sn_images where picture_id='".sbGet('pic_id')."'");
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
 $sql="DELETE FROM sn_pictures WHERE pic_id='".sbGet('pic_id')."' $where";
  $qry->queryDelete($sql);
  
 $sql="DELETE FROM sn_images WHERE picture_id='".sbGet('pic_id')."'";

 $qry->queryDelete($sql);
 phpredirect("records.php");

  
}

//Change Password//
if(isset($_REQUEST["ChangePassword"]))
{
	
	$oldpassword = md5(trim(strip_tags(sbGet('password'))));
	$password = md5(trim(strip_tags(sbGet('pwd1'))));

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
	
	
	
//Change Password//
if(isset($_REQUEST["updateAccount"]))
{
	


$data = array("firstname","middlename","lastname","address","zip","email");
$table= "sn_users";
quickUpdate($table, $data, array("user_id",$_SESSION['user_id']));


$_SESSION['updateProfile']=1;	
phpredirect("account.php");
	
}


	
//Change Password//
if(isset($_REQUEST["updateMember"]))
{
	
if(sbGet("password")=="")
$data = array("firstname","middlename","lastname","address","zip","email");
else
$data = array("firstname","middlename","lastname","address","zip","email", "password");
$table= "sn_users";
quickUpdate($table, $data, array("user_id",sbGet('members_user_id')));


$_SESSION['updateProfile']=1;	
phpredirect("editMembers.php?user_id=".sbGet('members_user_id'));
	
}


//Php code to delete from databse
if(isset($_REQUEST['deleteMembers']))
{		

		$sql="DELETE FROM  sn_users WHERE user_id='".sbGet('user_id')."'";
 		$qry->queryDelete($sql);
		$sql="DELETE FROM  sn_pictures WHERE user_id='".sbGet('user_id')."'";
 		$qry->queryDelete($sql);
 		phpredirect("members.php");

  
}	

//Php code to delete from databse
if(isset($_REQUEST['deleteBills']))
{		

		$sql="DELETE FROM  sn_pictures WHERE pic_id='".sbGet('pic_id')."'";
 		$qry->queryDelete($sql);
 		phpredirect("members.php");

  
}		
	

//Php code to delete from databse
if(isset($_REQUEST['del_id']))
{		$pic_id = sbGet('pic_id');
	  	$query = "select * from sn_images where id='".sbGet('del_id')."'";
		$pic=$qry->querySelectSingle($query);
		$sql="DELETE FROM  sn_images WHERE id='".sbGet('del_id')."'";
		unlink('uploads/'.$pic['file']);
		unlink('uploads/thumbs/'.$pic['file']);
 		$qry->queryDelete($sql);
 		phpredirect("editUploads.php?pic_id=$pic_id");

  
}



if(isset($_REQUEST['contactUser']))
{
					//Header Information
					$to =  getData("email","sn_users",array("user_id", sbGet("user_id")));
					$email = sbGet("email");
					$subject = 'Website Change Request';

					$headers = "From: info@domain.com \r\n";
					$headers .= "Reply-To: ". $email . "\r\n";
					$headers .= "CC: info@example.com\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

					//message

					$message=sbGet("message");

					mail($to, $subject, $message, $headers);
				phpalert("Message Sent Successfully!");
			phpredirect("view.php?picture_id=".sbGet("pic_id"));
}
?>