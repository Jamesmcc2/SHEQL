<?php include "includes/header.php";



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
<?php



//Validate the request brought
if(isset($_REQUEST["($1)"])) && !empty(sbGet("Register")))
{
	
	$email = trim(strip_tags(sbGet('email')));
	$password = trim(strip_tags(sbGet('password')));
	$unique_id=rand(10000000,99999999);
	$kid= $unique_id;
	$encrypted_password = md5($password);
	$f_sql = mysql_query("SELECT COUNT(*) FROM sn_users WHERE email='$email'");
	$email_count = mysql_result($f_sql, 0); 

	
	if($email_count>0)
	{
		echo "<div align=center class='alert-danger alert'>Sorry, Email address already registered. Thanks.</div>";
	}
	else
	{

	$results=$qry->queryExecute("INSERT INTO `sn_users` (
`password` ,
`email` ,
`unique_id`
)
VALUES ('".$encrypted_password."', '".$email."','".$kid."')");


		$query = "select * from  sn_users where email='$email'";
				$post_data = $qry->querySelectSingle($query);
		$_SESSION['new_user_id']=$post_data['user_id'];		
		$_SESSION['unique_id']=$post_data['unique_id'];
		$_SESSION['email_id']=$email;


		phpredirect("validate.php");
	}
	
	}
		?>


<div class="alert alert-info" role="alert" align="center"><span class="red">All fields marked with an asterisk (*) are required.</span></div>
<form method="post" enctype="multipart/form-data"  onsubmit="return validateForm()"  class="form-horizontal form-signin" name="myform" role="form">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label"><span class="red">*</span> Email</label>
    <div class="col-sm-8">
      <input name="email" type="email" required class="form-control" id="inputEmail3" value="<?php if(isset($_REQUEST['email'])) echo  sbGet('email'); ?>" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label"><span class="red">*</span> Password</label>
    <div class="col-sm-8">
      <input name="password" type="password" class="form-control" id="inputPassword3" value="<?php if(isset($_REQUEST['password'])) echo  sbGet('password'); ?>" placeholder="Password" required>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label"><span class="red">*</span> Confirm Password</label>
    <div class="col-sm-8">
      <input name="confirm" type="password" class="form-control" id="inputPassword3" value="<?php if(isset($_REQUEST['confirm'])) echo  sbGet('confirm'); ?>" placeholder="Password" required>
    </div>
  </div>
  <div class="form-group"></div>
  
  <div class="form-group">
    <div align="right" class="col-sm-offset-2 col-sm-8">
    <input name="Register" type="submit" class="btn btn-default" id="Register" value="Register">
    </div>
  </div>
</form>
<?php 
include"includes/footer.php"; ?>