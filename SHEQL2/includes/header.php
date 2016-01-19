<?php session_start(); 
include "class/db_connect.class.php";

include "class/sqlQuery.class.php";

include("class/resize-class.php");

if(isset($_REQUEST['logout']))
{
	unset($_SESSION['user_id']);
	unset($_SESSION['user_name']);
	unset($_SESSION['BrowseOn']);
	phpredirect("index.php");
}


function sbGet($data)
{
	return mysql_real_escape_string($_REQUEST[$data]); 
}

function getData($column, $table, $from)
{
	$query = "select `".$column."` from ".$table." where ".$from[0]."='".$from[1]."'";
	$qry = new query();
$post=$qry->querySelectSingle($query);
echo $post[$column];
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.ico">

    <title>Home</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="dist/css/datepicker.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
        <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
    
    <script>
	function initialise(){
	moveNumbers();
	}
    </script>
	<?
	function getFill($table, $field, $ID){
	$i=count($field);
	
	$query = "select * from `".$table."` where ".$ID[0]."='".$ID[1]."'";

	$qry = new query();
	$prod=$qry->querySelectSingle($query);
	

	?>
			<script>
            function moveNumbers() {
                <?
                for($k=0; $k<$i; $k++){
                 ?>
              document.getElementById("<? echo $field[$k]; ?>").value="<? echo $prod[$field[$k]]; ?>";
              <? } ?>
            }
            </script>
<? } ?>
<style>
.red{
	color:#f00;
	}
</style>
  </head>

  <body onload="initialise();" >

    
  
    <div class="container">

      <!-- Static navbar -->
      <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">SHEQL</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">

              <li><? if(isset($_SESSION['BrowseOn'])){?><a href="search.php">Search</a></li>
              <li><a href="upload.php">Upload</a></li><? } ?>
            </ul>
            <ul class="nav navbar-nav navbar-right"> 
            
            
               <? if(isset($_SESSION['user_id'])){?>
               <li><a href="#">Hello <? getData("firstname","sn_users",array("user_id", $_SESSION["user_id"]))?></a></li>
               <li><a href="favorite.php">Favorites</a></li>
              
               <li><a href="records.php">Your Bills</a></li>
			   <li><a href="account.php">My Account</a></li>
               <li><a href="change_pswd.php">Change Password</a></li>
             <li><a href="?logout">Log Out</a></li>
             <?  }else{ ?>
             <li><a href="login.php">Log In</a></li>
             <li><a href="register.php">Register</a></li>
			 
			 <?  } ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>
