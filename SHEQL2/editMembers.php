<? 
//Including top header file
include "includes/header.php"; ?>
<? if($super!=2) die("Not Found!!"); ?>
<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li class="active">Change Password</li>
</ol>

<? 
//If password is changed successfully
if(isset($_SESSION['updateProfile']))
{
?><body onLoad="moveNumbers();">
<div class="alert alert-success">Profile Updated Successfully!</div>
<? unset($_SESSION['updateProfile']);}?>
<form action="formHandler.php" method="post" enctype="multipart/form-data" name="myform"  class="form-horizontal form-signin"  onsubmit="return validateForm()" role="form">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">First Name</label>
    <div class="col-sm-8">
      <input name="firstname" type="text" onFocus="moveNumbers();" class="form-control" id="firstname"  placeholder="First Name" required>
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
       <input name="zip" type="text" class="form-control" id="zip" placeholder="Zip" required>
    </div>
  </div>
  
    <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Password</label>
    <div class="col-sm-8">
       <input name="password" type="password" class="form-control" id="zip">
    </div>
  </div>
  <div class="form-group"></div>
  
  <div class="form-group">
    <div align="right" class="col-sm-offset-2 col-sm-8">
    <input name="updateMember" type="submit" class="btn btn-default" id="updateMember" value="Change">
    </div>
  </div>
  <input name="members_user_id" type="hidden" class="form-control" id="user_id">
</form>
<?
//Including bottom footer file
include"includes/footer.php"; ?><?
	
	


getFill("sn_users", array("firstname","middlename","lastname","email","address","zip","user_id"), array("user_id", sbGet("user_id")));
?>