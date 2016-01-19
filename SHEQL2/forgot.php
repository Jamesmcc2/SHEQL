<?php 
//Including top header file
include "includes/header.php";
if(isset($_REQUEST['forgot_user_id']))
{$text='User ID';
$submit = 'forgetUserId';}
else{
	$text='Password';
$submit = 'forgetPassword';
	
	}
?><form action="formHandler.php" method="post" enctype="application/x-www-form-urlencoded">
<div class="row">

<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Forgot <?=$text?></h3>
      </div>
      <div class="panel-body">
      <?php if(isset($_SESSION['errorEmail'])){?>
      <div class="alert alert-danger">Email ID does not exist!</div>
      <?php unset($_SESSION['errorEmail']);} ?>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email Id</label>
    <div class="col-sm-10">
      <input name="emailID" type="Email Id" class="form-control" id="inputEmail3" placeholder="Email ID">
    </div>
  </div>



  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input name="<?=$submit?>" type="submit" class="btn btn-default" id="<?=$submit?>" value="Forgot" />
    </div>
  </div>
</div>
</div>

</div></form>
<?php 
//Including bottom footer file

include "includes/footer.php" ?>