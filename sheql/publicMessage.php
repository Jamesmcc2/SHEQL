<div class="row">
<form action="formHandler.php" method="post" enctype="application/x-www-form-urlencoded">
<div class="col-md-6">

<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Browse anonymously </h3>
      </div>
      <div class="panel-body">
      <? if(isset($_SESSION['ErrorBrowse'])){?>
      <div class="alert alert-danger">Please Agree on terms and conditions</div>
<?
unset($_SESSION['ErrorBrowse']);
} ?>
           <input type="checkbox" name="agree" value="1" id="CheckboxGroup1_1" />

I have read and agree with SHEQL Terms of Service.
      </div>
      
      <div class="panel-footer"><input name="formBrowse" type="submit" class="btn btn-primary" id="formBrowse" value="Browse"></div>
      
    </div>
</div>
</form>


<div class="col-md-6">

<div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Registered User</h3>
      </div>
      <div class="panel-body">

<? include"includes/login_form.php";?>
</div>
    </div>
</div>

</div>
<div style="font-family:Tahoma, Geneva, sans-serif; font-size:18px; color:#666666">You are in a public page. Please use the menu above to navigate. or click here to <a href="login.php">Login</a> or <a href="register.php">Register</a> </div>