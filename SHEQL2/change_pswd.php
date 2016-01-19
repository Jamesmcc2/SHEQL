<? 
//Including top header file
include "includes/header.php"; ?>
<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li class="active">Change Password</li>
</ol>
<? 
//If old password doesnt match
if(isset($_SESSION['MisMatchPsw']))
{
?><div class="alert alert-danger">Old Password doesnt match.</div>
<? unset($_SESSION['MisMatchPsw']);}?>

<? 
//If password is changed successfully
if(isset($_SESSION['ChangedPsw']))
{
?><div class="alert alert-success">Password Changed Sucessfully.</div>
<? unset($_SESSION['ChangedPsw']);}?>
<form action="formHandler.php" method="post" enctype="multipart/form-data" name="myform"  class="form-horizontal form-signin"  onsubmit="return validateForm()" role="form">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Old Password</label>
    <div class="col-sm-8">
       <input name="password" type="password" class="form-control" id="inputPassword" value="" placeholder="Password" required>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">New Password</label>
    <div class="col-sm-8">
      <input  class="form-control" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers" type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="pwd1" onchange=" this.setCustomValidity(this.validity.patternMismatch ? this.title : ''); if(this.checkValidity()) form.pwd2.pattern = this.value; ">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Confirm New Password</label>
    <div class="col-sm-8">
      <input  class="form-control" title="Please enter the same Password as above" type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="pwd2" onchange=" this.setCustomValidity(this.validity.patternMismatch ? this.title : ''); ">
    </div>
  </div>
  <div class="form-group"></div>
  
  <div class="form-group">
    <div align="right" class="col-sm-offset-2 col-sm-8">
    <input name="ChangePassword" type="submit" class="btn btn-default" id="ChangePassword" value="Change">
    </div>
  </div>
</form>
<?
//Including bottom footer file
include"includes/footer.php"; ?>