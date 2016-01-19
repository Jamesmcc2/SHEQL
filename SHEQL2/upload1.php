<?php include "includes/header.php";
   include "includes/validateCode.php";
?><br>
<style>
.add_field,.remove_field{
	background-color: #d3d3d3;
	width: 20px;
	height: 20px;
	display: inline-block;
	text-align: center;
	color: #0033ff;
	font-size: 19px;
	cursor: pointer;
}

.input_holder input{
	display:block;
}
</style>
<script>

function validateForm() {
    var x = document.forms["myform"];

    if (x["title"].value == null || x["title"].value == "" ) {
        alert("Title must be filled out");
		x["title"].focus() ;
        return false;
    }

	
	  if (x["type1"].checked == false && x["type2"].checked == false && x["type3"].checked == false  ) {
        alert("Type must be selected");
		x["type1"].focus() ;
        return false;
    }
	
	  if (x["keywords"].value == null || x["keywords"].value == "") {
        alert("Keyword must be filled out");
		x["keywords"].focus() ;
        return false;
    }
	
	 if (x["icd9"].value == null || x["icd9"].value == "") {
        alert("ICD9 must be filled out");
		x["icd9"].focus() ;
        return false;
    }
		  if (x["zip"].value == null || x["zip"].value == "") {
        alert("Zip code must be filled out");
		x["zip"].focus() ;
        return false;
    }
	
		  if (x["cost1"].value == null || x["cost1"].value == "") {
        alert("Full Cost must be filled out");
		x["cost1"].focus() ;
        return false;
    }
	
	if (x["cost2"].value == null || x["cost2"].value == "") {
        alert("Cost after insurance payments must be filled out");
		x["cost2"].focus() ;
        return false;
    }
	


}
</script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	
<script type="text/javascript">
 $(function(){
        $('.add_field').click(function(){
      
            var input = $('#input_clone');
            var clone = input.clone(true);
            clone.removeAttr ('id');
            clone.val('');
            clone.appendTo('.input_holder');
          
        });
  
        $('.remove_field').click(function(){
          
            if($('.input_holder input:last-child').attr('id') != 'input_clone'){
                  $('.input_holder input:last-child').remove();
            }
          
        });
})
  
</script>
<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
 <? if(isset($_SESSION['new_user_id']) ) {?> <li><a href="register.php">Register</a></li>
  <li class="active">Step 2</li><? }else{ ?>
  <li><a href="upload.php">Upload</a></li><? } ?>
</ol>
<?
if(!isset($_SESSION['BrowseOn']) )
phpredirect("index.php");

function filter($subject)
{
	$subject=addslashes(trim($subject));
	return $subject;
}


//Validate the request brought
if(isset($_REQUEST["Upload"]))
{

$keywords=sbGet('keywords');
$summary=sbGet('summary');
//$type=sbGet('type'];
$date=sbGet('date');
$title = sbGet('title');
			
		$type1 = 0;
			
		$type2 = 0;
			
		$type3 = 0;
		
		if(isset($_REQUEST['type1']))
		$type1 = 1;
			
		if(isset($_REQUEST['type2']))
		$type2 = 1;
		
		if(isset($_REQUEST['type3']))
		$type3 = 0;
			
		$icd9 = sbGet('icd9');
			
		$icd10 = sbGet('icd10');
			
	//	$file = sbGet('file_name'];
			
		$zip = sbGet('zip');
				
		//$file = sbGet('file_name'];
				
		$keywords = sbGet('keywords');
				
		$type = 0;
				
		$summary = sbGet('summary');
				
		$date = sbGet('date');
				
		$amount = sbGet('amount');
				
		$institution = sbGet('institution');
				
		$physician = sbGet('physician');
				
		$cost1 = sbGet('cost1');
				
		$cost2 = sbGet('cost2');
				
		$state = sbGet('state');
				
		$date = sbGet('date');

if(isset($_SESSION['user_id']))
$user_id=$_SESSION['user_id'];
if(isset($_SESSION['new_user_id']))
$user_id=$_SESSION['new_user_id'];
if(isset($_SESSION['BrowseOn']) && !isset($_SESSION['user_id']))
{
	$user_id=0;
	}


			/*if(isset($_FILES['image']) && $_FILES['image']['name']!='')
	{
    		$errors= array();
    		$file_name = $_FILES['image']['name'];
		    $file_size =$_FILES['image']['size'];
		    $file_tmp =$_FILES['image']['tmp_name'];
		    $file_type=$_FILES['image']['type'];   
			$tmp = explode('.', $_FILES['image']['name']);
		    $file_ext=end($tmp);
		    $extensions = array("jpeg","jpg","png"); 		
		    if(in_array($file_ext,$extensions )=== false)
			{
     			$errors[]="extension not allowed, please choose a JPEG or PNG file.";
    		}
    		
			if($file_size > 2097152)
			{
    			$errors[]='File size must be excately 2 MB';
   			 }				
    		if(empty($errors)==true){
        		move_uploaded_file($file_tmp,"uploads/".$file_name);
        		echo "Success";
    		}else{
        		print_r($errors);
    		}


	}elseif(isset($_REQUEST['pic']]){
		$file_name=sbGet('pic'];
		}else
		{
			$file_name="";
			}
*/
	$results=$qry->queryExecute("insert into  	sn_pictures		SET
			
				`title`					= '$title',
			
				`type1`					= '$type1',
			
				`type2`					= '$type2',
			
				`type3`					= '$type3',
			
				`icd9`					= '$icd9',
			
				`icd10`					= '$icd10',
			
				`zip`					= '$zip',
				
				
				`keywords`					= '$keywords',
				
				
				`summary`					= '$summary',
				
				
				`amount`					= '$amount',
				
				`institution`					= '$institution',
				
				`physician`					= '$physician',
				
				`cost1`					= '$cost1',
				
				`cost2`					= '$cost2',
				
				`state`					= '$state',
				
				`date`					= '$date',

				`user_id`			= '$user_id'");
	
	$query = "select * from sn_pictures	 where user_id='".$user_id."' order by `pic_id` desc";
$img=$qry->querySelectSingle($query);
	
	$picture_id=$img['pic_id'];
	$folder="uploads";

//Check if there are any files ready for upload
if(isset($_FILES['uploaded_files']))
{
	//For each file get the $key so you can check them by their key value
	foreach($_FILES['uploaded_files']['name'] as $key => $value)
	{
	
		//If the file was uploaded successful and there is no error
		if(is_uploaded_file($_FILES['uploaded_files']['tmp_name'][$key]) &&	$_FILES['uploaded_files']['error'][$key] == 0)
        {
            
			//Create an unique name for the file using the current timestamp, an random number and the filename			
			$filename = $_FILES['uploaded_files']['name'][$key];
            $filename = time().rand(0,999).$filename;
            
			//Check if the file was moved
			if(move_uploaded_file($_FILES['uploaded_files']['tmp_name'][$key], $folder.'/' . $filename))
            {	// *** 1) Initialise / load image
	$createThumbs = new resize($folder.'/' . $filename);

	// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
	$createThumbs -> resizeImage(200, 120, 'crop');

	// *** 3) Save image
	$createThumbs -> saveImage($folder.'/thumbs/' . $filename, 100);
	
	
	
				$results=$qry->queryExecute("insert into sn_images(file,picture_id) values('$filename','$picture_id')");
                echo '<div class="alert alert-success">The file ' . $_FILES['uploaded_files']['name'][$key].' was uploaded successful <br/></div>';
            }
            else
			{
			echo move_uploaded_file($_FILES['uploaded_files']['tmp_name'][$key],$folder. $filename);
				echo '<div class="alert alert-danger">The file was not moved.</div>';
            }
				
        }
		else
        {
			echo '<div class="alert alert-danger">The file was not uploaded.</div>';
        }
	}
}

//now validating the username and password
$sql="SELECT user_id FROM  sn_pictures WHERE user_id='".$user_id."'";


$result=mysql_query($sql);
$row=mysql_fetch_array($result);

//if username exists
if(mysql_num_rows($result)<=1)
{
	complete($user_id);	
	$qry->queryExecute("UPDATE sn_users SET `status` = '2' where user_id='".$user_id."'");

	
}

	if(isset($_SESSION['user_id']) || isset($_SESSION['BrowseOn'])){
	//phpredirect("?done");
	}
	else
	phpredirect("validate.php");
	}
		?>
<div class="alert alert-info" role="alert" align="center"><span class="red">All fields marked with an asterisk (*) are required.</span></div>
<? if(isset($_REQUEST['done'])){?>Uploaded Successfully<? }?>

<form action="?" method="post" enctype="multipart/form-data" name="myform"   onsubmit="return validateForm()"  class="form-horizontal form-signin" role="form"><div class="form-group">
  <label for="inputEmail3" class="col-sm-4 control-label"><span class="red">*</span> Title</label>
    <div class="col-sm-8">
      <input  class="form-control" name="title" id="title" placeholder="Title" type="text" required />
    </div>
  </div>
  
  <div class="form-group">
  <label for="inputEmail3" class="col-sm-4 control-label"><span class="red">*</span> Medical Service Type</label>
    <div class="col-sm-8">
      <input name="type1" type="checkbox" id="type1" value="">
      Type 1 &nbsp;&nbsp; <input name="type2" type="checkbox" id="type2" value="">
      Type 2&nbsp;&nbsp; 
      <input name="type3" type="checkbox" id="type3" value="">
      Type 3    </div>
  </div>
  <div class="form-group">
  <label for="inputEmail3" class="col-sm-4 control-label"><span class="red">*</span>  ICD9</label>
    <div class="col-sm-8">
      <input  class="form-control" name="icd9" id="icd9" placeholder="ICD9" type="text" required />
    </div>
  </div>
  <div class="form-group">
  <label for="inputEmail3" class="col-sm-4 control-label">ICD10</label>
    <div class="col-sm-8">
      <input  class="form-control" name="icd10" id="icd10" placeholder="ICD10" />
    </div>
  </div>
  <div class="form-group">
  <label for="inputEmail3" class="col-sm-4 control-label"><span class="red">*</span> Zip Code</label>
    <div class="col-sm-8">
      <input  class="form-control" name="zip" id="zip" placeholder="Zip Code" type="text" required />
    </div>
  </div>

  <div class="form-group">
  <label for="inputEmail3" class="col-sm-4 control-label">Date</label>
    <div class="col-sm-8">
      <input name="date" class="datepicker form-control" id="date" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd">
    </div>
  </div>
  <div class="form-group">
  <label for="inputEmail3" class="col-sm-4 control-label">Amount</label>
    <div class="col-sm-8">
      <input  class="form-control" name="amount" id="amount" placeholder="Amount" />
    </div>
  </div>
  <div class="form-group">
  <label for="inputEmail3" class="col-sm-4 control-label">Institution</label>
    <div class="col-sm-8">
      <input  class="form-control" name="institution" id="institution" placeholder="Institution" />
    </div>
  </div>
  <div class="form-group">
  <label for="inputEmail3" class="col-sm-4 control-label">Physician</label>
    <div class="col-sm-8">
      <input  class="form-control" name="physician" id="physician" placeholder="Physician" />
    </div>
  </div>
  <div class="form-group">
  
    <label for="inputEmail3" class="col-sm-4 control-label"><span class="red">*</span> Image</label>
    <div class="col-sm-7 input_holder">

        <input  class="form-control" name="uploaded_files[]" type="file" required   id="input_clone">
    </div><div class="col-sm-1">
  <span class="add_field">+</span>
<span class="remove_field">-</span>
</div>
  </div>
  <div class="form-group">
  <label for="inputEmail3" class="col-sm-4 control-label"><span class="red">*</span> Full Cost</label>
    <div class="col-sm-8">
      <input  class="form-control" name="cost1" id="cost1" placeholder="Full Cost" />
    </div>
  </div>
  <div class="form-group">
  <label for="inputEmail3" class="col-sm-4 control-label"><span class="red">*</span> Cost after insurance payments</label>
    <div class="col-sm-8">
      <input  class="form-control" name="cost2" id="cost2" placeholder="Cost after insurance payments" />
    </div>
  </div>
<div class="form-group">
  <label for="inputEmail3" class="col-sm-4 control-label"><span class="red">*</span> Keywords</label>
    <div class="col-sm-8">
      <textarea class="form-control" name="keywords" id="inputEmail3" placeholder="Keywords"></textarea>
    </div>
  </div>
  <div class="form-group">
  <label for="inputEmail3" class="col-sm-4 control-label">Summary</label>
    <div class="col-sm-8">
      <textarea class="form-control" name="summary" id="inputEmail3" placeholder="Summary"></textarea>
    </div>
  </div>
  <div class="form-group">
  <div class="col-sm-12" align="right">
  <label for="inputEmail3" class="control-label"> State of the billing event</label>

      &nbsp;&nbsp;
<input name="state" type="radio" value="Preliminary" checked>Preliminary  &nbsp;&nbsp;
<input name="state" type="radio" value="Final"> 
      Final
    </div>
  </div>
<div class="form-group">
  <div align="right" class="col-sm-offset-2 col-sm-8">
    <input name="Upload" type="submit" class="btn btn-default" id="Upload" value="Upload">
    </div>
  </div>
</form>
<? include"includes/footer.php"; ?>