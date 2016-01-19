<?php 

define("dbhost","localhost",true);
define("uname","root",true);
define("password","root",true);
define("dbname","sheql1",true);

//connection class
class database{
	
	var $link;
	
	function  database($dbhost,$uname,$password, $dbname){
		
		$this->link=@mysql_connect($dbhost,$uname,$password) or die("Error:=>Could not connect");
		
		mysql_select_db($dbname,$this->link);//
		
	}//enf of function
	
}//enf of class

$db = new database(dbhost,uname,password,dbname);
?>