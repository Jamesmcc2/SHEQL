<? 
//Including top header file
include "includes/header.php"; ?>
<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li class="active">Change Password</li>
</ol>

<? 
//If password is changed successfully
if(isset($_SESSION['updateProfile']))
{
?><body onload="moveNumbers();">
<div class="alert alert-success">Profile Updated Successfully!</div>
<? unset($_SESSION['updateProfile']);}?>
<form action="formHandler.php" method="post" enctype="multipart/form-data" name="myform"  class="form-horizontal form-signin"  onsubmit="return validateForm()" role="form">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">First Name</label>
    <div class="col-sm-8">
      <input name="firstname" type="text" onfocus="moveNumbers();" class="form-control" id="firstname"  placeholder="First Name" required>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Middle Name</label>
    <div class="col-sm-8">
       <input name="middlename" type="text" class="form-control" id="middlename"  placeholder="Middle Name" required>
    </div>
  </div>
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Last Name</label>
    <div class="col-sm-8">
       <input name="lastname" type="text" class="form-control" id="lastname" value="" placeholder="Last Name" required>
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Email</label>
    <div class="col-sm-8">
       <input name="email" type="text" class="form-control" id="email" value="" placeholder="Last Name" required>
    </div>
  </div>
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Address</label>
    <div class="col-sm-8">
       <input name="address" type="text" class="form-control" id="address" value="" placeholder="Address" required>
    </div>
  </div>
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Zip</label>
    <div class="col-sm-8">
       <input name="zip" type="text" class="form-control" id="zip" value="" placeholder="Zip" required>
    </div>
  </div>

  <div class="form-group"></div>
  
  <div class="form-group">
    <div align="right" class="col-sm-offset-2 col-sm-8">
    <input name="updateAccount" type="submit" class="btn btn-default" id="updateAccount" value="Change">
    </div>
  </div>
</form>
<?
//Including bottom footer file
include"includes/footer.php"; ?><?
	
	


getFill("sn_users", array("firstname","middlename","lastname","email","address","zip" ), array("user_id", $_SESSION["user_id"]));
?>