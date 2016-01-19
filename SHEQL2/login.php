<?php 
//Including top header file
include "includes/header.php" ?>

<?php 
if(isset($_SESSION['user_id']))
{
	phpredirect("index.php");;
}
if(isset($_REQUEST['LogIn']))
{
	//get the posted values
$user_id=htmlspecialchars(sbGet('user_id'),ENT_QUOTES);
$pass=md5(sbGet('password'));

//now validating the username and password
$sql="SELECT unique_id, password FROM  sn_users WHERE unique_id='".$user_id."' AND password='".$pass."' AND status>=1";


$result=mysql_query($sql);
$row=mysql_fetch_array($result);

//if username exists
if(mysql_num_rows($result)>0)
{
	//compare the password
	if(strcmp($row['password'],$pass)==0)
	{
			echo "<div class=\"alert alert-success\" role=\"alert\">Login Successful.</div>"; //Invalid Login
		phpredirect("index.php");
		
		//now set the session from here if needed
		
		
		$query = "select * from  sn_users where  unique_id='".$user_id."' AND password='".$pass."' ";
		$data = $qry->querySelectSingle($query);
		$_SESSION['user_name']=$data['user_name']; 
		$_SESSION['user_id']=$data['user_id'];
		$_SESSION['BrowseOn']=1;
	}
	else
	echo "<div class=\"alert alert-danger\" role=\"alert\">Incorrect Username or Password</div>"; //Invalid Login
}
else
	echo "<div class=\"alert alert-danger\" role=\"alert\">Incorrect Username or Password</div>"; //Invalid Login


}

?>
<div class="row">
<div class="col-md-12">
<div class="panel panel-primary">
<div class="panel-heading">Log In</div>
<div class="panel-body">
<?php include"includes/login_form.php"; ?>
</div>
</div>
</div>
</div>
<?php 
//Including bottom footer file
include"includes/footer.php"; ?>