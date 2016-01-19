<? 
//Including top header file
include "includes/header.php";
//Including file with validation email code
include "includes/validateCode.php";
   
//If No PIC id in the URL
if(!isset($_REQUEST['pic_id'])) die("<div class='alert alert-danger'>No Records found.</div>");
$pic_id 	 = sbGet('pic_id');

//Retrieve data from database for view in field
$query = "select * from sn_pictures where pic_id='$pic_id'";
$post=$qry->querySelectSingle($query);

?>
<!-- Script for delete confirmation -->
<script type="text/javascript">
  
function confirmAction(){
      var confirmed = confirm("Are you sure? This will remove this entry forever.");
      return confirmed;
}
</script>



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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<!-- Code for multiple file upload cloning -->	
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
 <? 
 if(isset($_SESSION['new_user_id']) ) {?> <li><a href="register.php">Register</a></li>
  <li class="active">Step 2</li><? }else{ ?>
  <li><a href="upload.php">Upload</a></li><? } ?>
</ol>
<?

//if user hasnot agreed on the terms and condition or if user is not logged in
if(!isset($_SESSION['BrowseOn']) )
phpredirect("index.php");


//For filtering messeges
function filter($subject)
{
	$subject=addslashes(trim($subject));
	return $subject;
}


//Validate the request brought
if(isset($_REQUEST["Upload"]))
{

		$keywords			=		sbGet('keywords');
		
		$description 		=	 	sbGet('description');
			
		$medical_code	 	= 		sbGet('medical_code');
			
		$facility 			= 		sbGet('facility');
			
		$facility_zip_code 	= 		sbGet('facility_zip_code');
				
		$keywords 			= 		sbGet('keywords');
								
		$cost 				= 		sbGet('cost');
				
		$date 				= 		sbGet('date');
	
		$physician 			= 		sbGet('physician');

		if(isset($_SESSION['user_id']))
		$user_id=$_SESSION['user_id'];
		if(isset($_SESSION['new_user_id']))
		$user_id=$_SESSION['new_user_id'];
		
		//check if the user is registered user or non registered user
		if(isset($_SESSION['BrowseOn']) && !isset($_SESSION['user_id']))
		{
			//if user is unregistered user then consider the user_id as 0
			$user_id=0;
		}


	//Update bill information
	$results=$qry->queryExecute("UPDATE  	sn_pictures		SET
			
				`description`					= '$description',
			
				`medical_code`					= '$medical_code',
			
				`facility`						= '$facility',
			
				`facility_zip_code`				= '$facility_zip_code',
			
				`cost`							= '$cost',
								
				`keywords`						= '$keywords',
				
				`physician`						= '$physician',
				
				`date`							= '$date',

				`user_id`						= '$user_id'
				
				 where pic_id='".$pic_id."'
				");

	
	//retrieve the data of just uploaded data
	$query = "select * from sn_pictures	 where user_id='".$user_id."' order by `pic_id` desc";
	$img=$qry->querySelectSingle($query);
	
	$picture_id=$img['pic_id'];
	$folder="uploads";

/*
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
	
	
	
				$results=$qry->queryExecute("insert into sn_images(file,picture_id) values('$filename','$pic_id')");
                echo '<div class="alert alert-success">The file ' . $_FILES['uploaded_files']['name'][$key].' was uploaded successful <br/></div>';
            }
            else
			{
			echo move_uploaded_file($_FILES['uploaded_files']['tmp_name'][$key],$folder. $filename);
			//	echo '<div class="alert alert-danger">The file was not moved.</div>';
            }
				
        }
		else
        {
		//	echo '<div class="alert alert-danger">The file was not uploaded.</div>';
        }
	}
	
	
	phpredirect("?pic_id=".$pic_id);
}


*/
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

phpredirect("editUploads.php?pic_id=".sbGet("pic_id"));

	if(isset($_SESSION['user_id']) || isset($_SESSION['BrowseOn'])){
	//phpredirect("?done");
	}
	else
	//if user is first time user then validate
	phpredirect("validate.php");
	}
?>
<? 
//display uploaded sucessfully
if(isset($_REQUEST['done'])){?>
Uploaded Successfully<? }?>
<div class="row">

<div class="col-md-2">


   
 

    <?
		//retrieve images associated with the reccord
		$queryData="Select *from sn_images where picture_id='".$pic_id."' ";
			$qry_all_prod=$qry->querySelect($queryData);
			foreach($qry_all_prod as $prod)
			{?> <div class="thumbnail"> <img src="uploads/thumbs/<?=$prod['file'] ?>"><div align="center"><a onClick="return confirmAction();" href="formHandler.php?del_id=<?=$prod['id'] ?>&pic_id=<?=$pic_id ?>">Delete</a></div></div><? } ?>

    </div>

<div class="col-md-10 thumbnail">
<form action="?pic_id=<?=$pic_id ?>" method="post" enctype="multipart/form-data" name="myform"   onsubmit="return validateForm()"  class="form-horizontal form-signin" role="form"><div class="form-group">
  <label for="inputEmail3" class="col-sm-4 control-label"><span class="red">*</span> Description</label>
    <div class="col-sm-8">
      <textarea  maxlength="40" name="description" class="form-control" id="description" placeholder="Title" required="required"><?=$post['description']?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label"><span class="red">*</span> Keywords</label>
    <div class="col-sm-8">
      <textarea   maxlength="140" class="form-control" name="keywords" id="inputEmail3" placeholder="Keywords"><?=$post['keywords']?></textarea>
    </div>
  </div>
  <div class="form-group">
  <label for="inputEmail3" class="col-sm-4 control-label">Physician</label>
    <div class="col-sm-8">
      <textarea   maxlength="40" name="physician" class="form-control" id="physician" placeholder="Physician"><?=$post['physician']?></textarea>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Billing Code</label>
    <div class="col-sm-8">
      <textarea  maxlength="40" name="medical_code" class="form-control" id="medical_code" placeholder="Medical Code"><?=$post['medical_code']?></textarea>
    </div>
  </div>
  <div class="form-group">
  <label  maxlength="40" for="inputEmail3" class="col-sm-4 control-label">Facility</label>
    <div class="col-sm-8">
      <textarea name="facility" class="form-control" id="facility" placeholder="Facility"><?=$post['facility']?></textarea>
    </div>
  </div>
  <div class="form-group">
  <label for="inputEmail3" class="col-sm-4 control-label"><span class="red">*</span> Facility Zip Code</label>
    <div class="col-sm-8">
      <input  maxlength="5"  class="form-control" name="facility_zip_code" id="facility_zip_code" placeholder="Facility Zip Code" value="<?=$post['facility_zip_code']?>" type="text" required />
    </div>
  </div>

  <div class="form-group">
  <label for="inputEmail3"  class="col-sm-4 control-label">Date</label>
    <div class="col-sm-8"><? $originalDate = $post['date'];
$newDate = date("Y-m-d", strtotime($originalDate));

?>
      <input name="date" type="date" value="<?php echo $newDate; ?>" class="form-control" id="date">
    </div>
  </div>
  <div class="form-group">
  <label for="inputEmail3" class="col-sm-4 control-label">Cost</label>
    <div class="col-sm-8">
      <input  class="form-control" title="Enter a numeric value" name="cost" id="cost" pattern="\d+(\.\d{2})?" value="<?=$post['cost']?>" placeholder="Cost" />
    </div>
  </div>
  
  <!--
  <div class="form-group">
  
    <label for="inputEmail3" class="col-sm-4 control-label"><span class="red">*</span> Image</label>
    <div class="col-sm-7 input_holder">

        <input  class="form-control" name="uploaded_files[]" type="file" id="input_clone">
    </div><div class="col-sm-1">
  <span class="add_field">+</span>
<span class="remove_field">-</span>
</div>
  </div>
-->
  <div class="form-group">
    <div align="right" class="col-sm-offset-2 col-sm-8">
    <input name="Upload" type="submit" class="btn btn-default" id="Upload" value="Upload">
    </div>
  </div>
</form></div></div>
<? 
//Including bottom footer file
include"includes/footer.php"; ?>