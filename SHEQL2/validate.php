<? 
//Including top header file
include "includes/header.php";

//Contains the code for validation and email
include "includes/validateCode.php";
   ?>
<?

if(isset($_REQUEST['send']))
{
			$unique_id=sbGet('unique_id');
			$user_id=sbGet('user_id');

	
			//check if there is any user with the unique id and user id for validation
			$f_sql = mysql_query("SELECT COUNT(*) FROM  sn_users WHERE md5(unique_id)='".$unique_id."' AND user_id='".$user_id."'");
			$numrow = mysql_result($f_sql, 0); 
		
		
			//if username exists
			if($numrow>0)
			{
				$results=$qry->queryExecute("update sn_users set  status=1 where md5(unique_id)='".$unique_id."' ");
				?> 
        		<div class="alert alert-success" role="alert">Your email is Validated... Please Check your Inbox for your User ID</a></div>
                
				<?  	
				//email MetCompany About Registration & user his User ID
				notification($user_id);
			}
		//if invalid activation
		else
		?>
		
        		<div class=\"alert alert-danger\" role=\"alert\">Validation failed</div>
		
		<? 
}else{
	
	//validation page

?>
<div class="alert alert-info" role="alert"><h2>Thank you!</h2>
<div>Please check your email for validation</div>
</div>
<? 		
$user_id=$_SESSION['new_user_id'];		
$unique_id=$_SESSION['unique_id'];
$email_id=$_SESSION['email_id'];

//send validation email to the user
validate($email_id,$user_id,md5($unique_id));
unset($_SESSION['new_user_id'],$_SESSION['unique_id'],$_SESSION['email_id']);

} 
//Including bottom footer file
include "includes/footer.php"; ?>