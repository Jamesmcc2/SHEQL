       <form action="login.php" method="post" enctype="multipart/form-data" class="form-horizontal form-signin" role="form">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">User ID</label>
    <div class="col-sm-10">
      <input name="user_id" type="username" class="form-control" id="inputEmail3" placeholder="User ID" required>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input name="password" type="password" class="form-control" id="inputPassword3" placeholder="Password"  required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input name="LogIn" type="submit" class="btn btn-default" id="LogIn" value="Sign In" />
    </div>
  </div>
</form>  
<ul>
<li><a href="forgot.php">Forgot Password?</a></li>
<li><a href="forgot.php?forgot_user_id">Forgot User ID?</a></li>
</ul>