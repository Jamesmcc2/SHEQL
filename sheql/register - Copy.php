<? include "includes/header.php";



?>
<script>

function validateForm() {
    var x = document.forms["myform"];
	
	if (document.getElementById('chk1').checked==false || document.getElementById('chk2').checked==false  || document.getElementById('chk3').checked==false ) {
        alert("You must agree on terms and condition");
		document.getElementById('chk1').focus();
        return false;
    }
	
    if (x["user_name"].value == null || x["user_name"].value == "" ) {
        alert("Username must be filled out");
		x["user_name"].focus() ;
        return false;
    }
	
	  if (x["email"].value == null || x["email"].value == "") {
        alert("Email must be filled out");
		x["email"].focus() ;
        return false;
    }
	
	  if (x["password"].value == null || x["password"].value == "") {
        alert("Password must be filled out");
		x["password"].focus() ;
        return false;
    }
	


	  if (x["firstname"].value == null || x["firstname"].value == "") {
        alert("First name must be filled out");
		x["firstname"].focus() ;
        return false;
    }
	
	
	  if (x["lastname"].value == null || x["lastname"].value == "") {
        alert("Last name must be filled out");
		x["lastname"].focus() ;
        return false;
    }
	
	
	  if (x["address"].value == null || x["address"].value == "") {
        alert("Adress must be filled out");
		x["address"].focus() ;
        return false;
    }
	
	 if (x["zip"].value == null || x["zip"].value == "") {
        alert("Zip must be filled out");
		x["zip"].focus() ;
        return false;
    }
	
	if (x["password"].value != x["confirm"].value) {
        alert("Confirm password doesnt match");
		x["confirm"].focus() ;
        return false;
    }
	

	
}
</script>
<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li><a href="register.php">Register</a></li>
  <li class="active">Step 1</li>
</ol>
<?



//Validate the request brought
if(isset($_POST["Register"]) && !empty($_POST["Register"]))
{
	$firstname = trim(strip_tags($_POST["firstname"]));
	$middlename = trim(strip_tags($_POST["middlename"]));
	$lastname = trim(strip_tags($_POST["lastname"]));
	$user_name = trim(strip_tags(strtolower($_POST["user_name"])));
	$email = trim(strip_tags($_POST['email']));
	$address = trim(strip_tags($_POST['address']));
	$zip = trim(strip_tags($_POST['zip']));
	$password = trim(strip_tags($_POST['password']));
	$unique_id=rand(1000000000,9999999999);
	$kid= $unique_id;
	$encrypted_password = md5($password);
	$f_sql = mysql_query("SELECT COUNT(*) FROM sn_users WHERE email='$email' AND status=1");
	$email_count = mysql_result($f_sql, 0); 
	$f_sql = mysql_query("SELECT COUNT(*) FROM sn_users WHERE user_name='$user_name' AND status=1");
	$user_count = mysql_result($f_sql, 0); 
	
	if (!isset($_POST["chk1"]) || !isset($_POST["chk2"]) || !isset($_POST["chk3"])) {
		echo "<div align=center class='alert-danger alert'>Sorry, You need to accept all terms and condition. Thanks.</div>";
		}
	elseif ($_POST["captcha"] != $_SESSION['captcha']) {
		echo "<div align=center class='alert-danger alert'>Sorry, Incorrect Captcha. Thanks.</div>";
		}
	elseif($email_count>0)
	{
		echo "<div align=center class='alert-danger alert'>Sorry, Email address already registered. Thanks.</div>";
	}
	elseif($user_count>0)
	{
		echo "<div align=center class='alert-danger alert'>Sorry, Username already registered. Thanks.</div>";
	}elseif($firstname == "" | $lastname == ""   | $user_name == "" | $address == "" | $email == "" | $zip == "" | $password == "") //Be sure that all the fields are filled then proceed
	{
		echo "<div align=center class='alert-danger alert'>Sorry, you have to fill in all the fields to proceed. Thanks.</div>";
	}
	else if(strlen($user_name) < 5)
	{
		echo "<div align=center class='alert-danger alert'>Sorry, your username must not be less than 5 characters in length please. Thanks.</div>";
	}
	else if(preg_match('[^A-Za-z0-9]', $user_name))  //Be sure that username is properly formatted then proceed
	{
		echo "<div align=center class='alert-danger alert'>Sorry, <font color='blue'>".$user_name."</font> is not in the proper format for a username. <br>Username should only contain letters and numbers.<br>Example formats: <font color='blue'>comfort</font>, <font color='blue'>victor18</font>, <font color='blue'>chuks29</font>, <font color='blue'>lemdy</font>, <font color='blue'>joyce</font>, <font color='blue'>prisca</font>, <font color='blue'>ibrahim</font>, <font color='blue'>Ahmad</font> etc</div>";
	}
	else
	{

	$results=$qry->queryExecute("INSERT INTO `sn_users` (
`user_name` ,
`password` ,
`email` ,
`firstname` ,
`middlename` ,
`lastname` ,
`address` ,
`unique_id`,
`zip`

)
VALUES (
'".$user_name."', '".$encrypted_password."', '".$email."', '".$firstname."','".$middlename."', '".$lastname."', '".$address."', '".$kid."', '".$zip."'
)");


		$query = "select * from  sn_users where email='$email'";
				$post_data = $qry->querySelectSingle($query);
		$_SESSION['new_user_id']=$post_data['user_id'];		
		$_SESSION['unique_id']=$post_data['unique_id'];
		$_SESSION['email_id']=$email;


		phpredirect("upload.php");
	}
	
	}
		?>


<div class="alert alert-info" role="alert" align="center"><span class="red">All fields marked with an asterisk (*) are required.</span></div>
<form method="post" enctype="multipart/form-data"  onsubmit="return validateForm()"  class="form-horizontal form-signin" name="myform" role="form">
<div class="form-group">
    <label for="3" class="col-sm-4 control-label"><span class="red">*</span> Username</label>
    <div class="col-sm-8">
      <input name="user_name" type="user_name" class="form-control" id="3" value="<? if(isset($_POST['user_name'])) echo  $_POST['user_name']; ?>" placeholder="Username">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label"><span class="red">*</span> Email</label>
    <div class="col-sm-8">
      <input name="email" type="email" class="form-control" id="inputEmail3" value="<? if(isset($_POST['email'])) echo  $_POST['email']; ?>" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label"><span class="red">*</span> Password</label>
    <div class="col-sm-8">
      <input name="password" type="password" class="form-control" id="inputPassword3" value="<? if(isset($_POST['password'])) echo  $_POST['password']; ?>" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label"><span class="red">*</span> Confirm Password</label>
    <div class="col-sm-8">
      <input name="confirm" type="password" class="form-control" id="inputPassword3" value="<? if(isset($_POST['confirm'])) echo  $_POST['confirm']; ?>" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label"><span class="red">*</span> First Name</label>
    <div class="col-sm-8">
      <input name="firstname" type="firstname" class="form-control" id="inputEmail3" value="<? if(isset($_POST['firstname'])) echo  $_POST['firstname']; ?>" placeholder="First Name">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Middle Name</label>
    <div class="col-sm-8">
      <input name="middlename" type="middlename" class="form-control" id="inputEmail3" value="<? if(isset($_POST['middlename'])) echo  $_POST['firstname']; ?>" placeholder="Middle Name">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label"><span class="red">*</span> Last Name</label>
    <div class="col-sm-8">
      <input name="lastname" type="text" class="form-control" id="3" value="<? if(isset($_POST['lastname'])) echo  $_POST['lastname']; ?>" placeholder="Last Name">
    </div>
  </div>
  <div class="form-group">
    <label for="3" class="col-sm-4 control-label"><span class="red">*</span> Address</label>
    <div class="col-sm-8">
      <input name="address" type="text" class="form-control" id="3" value="<? if(isset($_POST['address'])) echo  $_POST['address']; ?>" placeholder="Address">
    </div>
  </div>
  <div class="form-group">
    <label for="3" class="col-sm-4 control-label"><span class="red">*</span> Zip-Code</label>
    <div class="col-sm-8">
      <input name="zip" type="text" class="form-control" id="3" value="<? if(isset($_POST['zip'])) echo  $_POST['zip']; ?>" placeholder="zip">
    </div>
  </div>
    <div class="form-group">
    <label for="3" class="col-sm-4 control-label"><span class="red">*</span> Captcha</label>
    <div class="col-sm-8">
     <div class="col-sm-6"> <img src="captcha/showCaptcha.php" /></div>
<div class="col-sm-6"><input  class="form-control"  type="text" name="captcha"/></div>
    </div>
  </div> 
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-8">
    <label>
      <strong>
      <input name="chk1" type="checkbox" id="chk1" value="yes"> 
      </strong></label>
    <strong>   Terms and condition 1</strong></div>
   <div class="col-sm-offset-2 col-sm-8">
     <strong>
     <label>
       <input name="chk2" type="checkbox" id="chk2" value="yes">
       Terms and condition 2</label>
     </strong></div>
   <div class="col-sm-offset-2 col-sm-8">
     <strong>
    <label>
      <input name="chk3" type="checkbox" id="chk3" value="yes"> 
    </label>
    Terms and condition 3</strong></div>
  </div>
  
  <div class="form-group">
    <div align="right" class="col-sm-offset-2 col-sm-8">
    <input name="Register" type="submit" class="btn btn-default" id="Register" value="Register">
    </div>
  </div>
</form>
<? 
include"includes/footer.php"; ?>