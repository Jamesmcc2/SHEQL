<?php 
//Including top header file
include "includes/header.php" ?>
<?php 
//when either logged on or aggred terms and condition
if(isset($_SESSION['user_id']) || isset($_SESSION['BrowseOn']) ){?>
 
<?php include "welcome.php"; ?>

<?php  
			 
	}else{ ?>
			 
             
<?php include "publicMessage.php"; ?>
<?php  } ?>



<?php 
//Including bottom footer file
include "includes/footer.php" ?>