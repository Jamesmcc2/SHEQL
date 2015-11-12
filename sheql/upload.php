<? 
//Including top header file
include "includes/header.php";

//Functions for email validation
include "includes/validateCode.php";

if(isset($_SESSION['user_id']))
$user_id=$_SESSION['user_id'];
if(isset($_SESSION['new_user_id']))
$user_id=$_SESSION['new_user_id'];

//User ID is 0 for anonymous user
if(isset($_SESSION['BrowseOn']) && !isset($_SESSION['user_id']))
	{
			$user_id=0;
	}?><br>
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
<!-- script to clone multiple file upload field -->	
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

//check if aggreed on terms and condtion or user is logged on
if(!isset($_SESSION['BrowseOn']) )
phpredirect("index.php");

//filter message
function filter($subject)
{
	$subject=addslashes(trim($subject));
	return $subject;
}


//Validate the request brought
if(isset($_POST["Upload"]))
{

		$keywords			=		$_REQUEST['keywords'];
		
		$description 		=	 	$_REQUEST['description'];
			
		$medical_code	 	= 		$_REQUEST['medical_code'];
			
		$facility 			= 		$_REQUEST['facility'];
			
		$facility_zip_code 	= 		$_REQUEST['facility_zip_code'];
				
		$keywords 			= 		$_REQUEST['keywords'];
								
		$cost 				= 		$_REQUEST['cost'];
				
		$date 				= 		$_REQUEST['date'];
	
		$physician 			= 		$_REQUEST['physician'];
	


		//Insert into databse
		$results=$qry->queryExecute("insert into  	sn_pictures		SET
			
				`description`					= '$description',
			
				`medical_code`					= '$medical_code',
			
				`facility`						= '$facility',
			
				`facility_zip_code`				= '$facility_zip_code',
			
				`cost`							= '$cost',
								
				`keywords`						= '$keywords',
				
				`physician`						= '$physician',
				
				`date`							= '$date',

				`user_id`						= '$user_id'");
	
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
	
	if(!isset($_SESSION['user_id']) && !isset($_SESSION['BrowseOn'])){
	//if neigther logged in or browser aggreed
	phpredirect("validate.php");
	}
	}		?>
<div class="alert alert-info" role="alert" align="center"><span class="red">All fields marked with an asterisk (*) are required.</span></div>
<? if(isset($_REQUEST['done'])){?>Uploaded Successfully<? }?>

<form action="?" method="post" enctype="multipart/form-data" name="myform"   onsubmit="return validateForm()"  class="form-horizontal form-signin" role="form"><div class="form-group">
  <label for="inputEmail3" class="col-sm-4 control-label"><span class="red">*</span> Description</label>
    <div class="col-sm-8">
      <textarea  maxlength="40" name="description" class="form-control" id="description" placeholder="Title" required="required"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label"><span class="red">*</span>  Medical Code</label>
    <div class="col-sm-8">
      <textarea  maxlength="40" name="medical_code" class="form-control" id="medical_code" placeholder="Medical Code" required="required"></textarea>
    </div>
  </div>
  <div class="form-group">
  <label  maxlength="40" for="inputEmail3" class="col-sm-4 control-label">Facility</label>
    <div class="col-sm-8">
      <textarea name="facility" class="form-control" id="facility" placeholder="Facility"></textarea>
    </div>
  </div>
  <div class="form-group">
  <label for="inputEmail3" class="col-sm-4 control-label"><span class="red">*</span> Facility Zip Code</label>
    <div class="col-sm-8">
      <input  maxlength="5"  class="form-control" name="facility_zip_code" id="facility_zip_code" placeholder="Facility Zip Code" type="text" required />
    </div>
  </div>

  <div class="form-group">
  <label for="inputEmail3" class="col-sm-4 control-label">Date</label>
    <div class="col-sm-8">
      <input name="date" class="datepicker form-control" id="date" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd">
    </div>
  </div>
  <div class="form-group">
  <label for="inputEmail3" class="col-sm-4 control-label">Cost</label>
    <div class="col-sm-8">
      <input  class="form-control" title="Enter a numeric value" name="cost" id="cost" pattern="\d+(\.\d{2})?" placeholder="Cost" />
    </div>
  </div>
  
  <div class="form-group">
  <label for="inputEmail3" class="col-sm-4 control-label">Physician</label>
    <div class="col-sm-8">
      <textarea   maxlength="40" name="physician" class="form-control" id="physician" placeholder="Physician"></textarea>
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
    <label for="inputEmail3" class="col-sm-4 control-label"><span class="red">*</span> Keywords</label>
    <div class="col-sm-8">
      <textarea   maxlength="140" class="form-control" name="keywords" id="inputEmail3" placeholder="Keywords"></textarea>
    </div>
  </div>
  <div class="form-group">
    <div align="right" class="col-sm-offset-2 col-sm-8">
    <input name="Upload" type="submit" class="btn btn-default" id="Upload" value="Upload">
    </div>
  </div>
</form>
<? 
//Including bottom footer file
include"includes/footer.php"; ?>