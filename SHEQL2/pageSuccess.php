<?php 
//Including top header file
include "includes/header.php";?>
<div class="row">
	<div class="col-md-12">
    	<div class="alert alert-success">
    	<? 
		//if forgot password using email
		if(isset($_SESSION['forget1']))
		{ 	echo "Successfully, emailed your password";
			unset($_SESSION['forget1']);
		}
		
		//if forgot user id
			if(isset($_SESSION['forget0']))
		{ 	echo "Successfully, emailed your user ID";
			unset($_SESSION['forget1']);
		}
		
		?>
        </div>
    </div>
</div>
<?php 
//Including bottom footer file
include "includes/footer.php";?>