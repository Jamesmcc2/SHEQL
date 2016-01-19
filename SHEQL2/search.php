<?php 
//Including top header file
include "includes/header.php" ?>
<?php 
if(isset($_SESSION['BrowseOn']))
include "home.php";
else
phpredirect("index.php");
?>
<?php 
//Including bottom footer file
include "includes/footer.php" ?>