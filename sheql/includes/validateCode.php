<? 
define("base_email", " -- enter email address -- ");
define("base_url", " -- enter website URL -- ");


function validate($email,$user_id,$unique_id)
{
	// multiple recipients
	$to  = $email . ', '; // note the comma
	$to .= base_email;

	// subject
	$subject = '[SHEQL] Email Verification';

	// message
	$message = '
	<html>
	<head>
		  <title>Email Verification</title>
			</head>
				<body>
  
		  			<p>Dear Member,</p>
					<p>Thank You for registering.</p>
					<p>Please Click here to confirm SHQEQL registration.
 
 
		   <div><a href=\''.base_url.'validate.php?send&user_id='.$user_id.'&unique_id='.$unique_id.'\'> Active my account <a/>
   
	   </div>

		<p>Thank You</p>


  		</p>
  
  
		</body>
		</html>
		';
	//	echo $message;
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers
		$headers .= 'To: User <'.$email.'>' . "\r\n";
		$headers .= 'From: SHEQL - enter email address ' . "\r\n";
		$headers .= 'Cc:  - enter email address' . "\r\n";
		$headers .= 'Bcc:  - enter email address' . "\r\n";

		// Mail it
	//	echo $message;
		mail($to, $subject, $message, $headers);
}
	
	
	
	
function	notification($user_id)
{
	
	$qry = new query;
		$query = "select * from sn_users where  user_id='".$user_id."'";
		$data=$qry->querySelectSingle($query);
		$name=$data["firstname"]." ".$data["lastname"];

		// multiple recipients
		$to = base_email;

// subject
$subject = "User '".$name."' has registered";

// message
$message = '
	<html>
	<head>
		  <title>User Registration</title>
			</head>
				<body>
  
		  			<p>Hello,</p>
					<p>"'.$data['unique_id'].'" has registered with SHEQL.</p>

		    
	   </div>

		<p>Thank You.</p>


  		</p>
  
  
		</body>
		</html>
		';
	//	echo $message;
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers
		$headers .= 'To: User <'.$to.'>' . "\r\n";
		$headers .= 'From: SHEQL  - enter email address ' . "\r\n";
		$headers .= 'Cc:  - enter email address' . "\r\n";
		$headers .= 'Bcc:  - enter email address' . "\r\n";
// echo $message;


		// Notifying MetCompaney
		mail($to, $subject, $message, $headers);
		
		
		
		
		
		
//Send User ID to 
	$email=$data['email'];
	// multiple recipients
	$to  = $email . ', '; // note the comma
	$to .= base_email;

	// subject
	$subject = 'User ID for SHEQL Login';

	// message
	$message = '
	<html>
	<head>
		  <title>User ID for SHEQL Login</title>
			</head>
				<body>
  
		  			<p>Dear Member,</p>
					<p>Your User ID is '.$data['unique_id'].'</p>
 
		   <div>Please Log In with this User ID <a href="'.base_url.'login.php"> Log In </a>
   
	   </div>

		<p>Thank You</p>


  		</p>
  
  
		</body>
		</html>
		';
	//	echo $message;
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers
		$headers .= 'To: User <'.$email.'>' . "\r\n";
		$headers .= 'From: SHEQL  - enter email address' . "\r\n";
		$headers .= 'Cc:  - enter email address' . "\r\n";
		$headers .= 'Bcc:  - enter email address' . "\r\n";
// echo $message;

		// Mail it
		mail($to, $subject, $message, $headers);
		
		
	}
	function	complete($user_id)
{
	
	$qry = new query;
		$query = "select * from sn_users  where  user_id='".$user_id."'";
		$data=$qry->querySelectSingle($query);
		$name=$data["firstname"]." ".$data["lastname"];
	
		
		
		
		
//Send User ID to 
	$email=$data['email'];
	// multiple recipients
	$to  = $email . ', '; // note the comma
	$to .= base_email;

	// subject
	$subject = '[SHEQL] Registration Complete';

	// message
	$message = '
	<html>
	<head>
		  <title>Registration Complete</title>
			</head>
				<body>
  
		  			<p>Congratulations '.$data['unique_id'].',</p>
					<p>you are now registered with SHEQL and can search for and view all medical bill images</p>
 
		   <div>Please <a href="'.base_url.'login.php"> Log In </a>
   
	   </div>

		<p>Thank You</p>


  		</p>
  
  
		</body>
		</html>
		';

		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers
		$headers .= 'To: User <'.$email.'>' . "\r\n";
		$headers .= 'From:  - enter email address' . "\r\n";
		$headers .= 'Cc:  - enter email address' . "\r\n";
		$headers .= 'Bcc:  - enter email address' . "\r\n";
// echo $message;

		// Mail it
		mail($to, $subject, $message, $headers);
		
		
	}
	?>