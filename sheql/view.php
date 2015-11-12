<? 
//Including top header file
include "includes/header.php";

//Retrieving data from database to show records of bills with the help of unique bill picture_id
$query = "select * from  sn_pictures where  	pic_id='".$_REQUEST['picture_id']."' ";
$data=$qry->querySelectSingle($query);
?>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>

<style>  
      ul li img {
          cursor: pointer;
      }</style>
<div class="row">
<? if(isset($_SESSION['user_id'])){?>
<div class="col-md-4">
<div class="container">
     <ul class="row">
   
 

    <?
		//Retrieving images associated with that bill
		$queryData="Select *from sn_images where picture_id='".$data['pic_id']."' ";
			$qry_all_prod=$qry->querySelect($queryData);
			foreach($qry_all_prod as $prod)
			{?> <li style="list-style:none; padding:0px;" class="col-lg-12"> <img class="thumbnail" src="uploads/thumbs/<?=$prod['file'] ?>"></li><? } ?>
        </ul>
</div>
    </div>
<? }?>
<div class="col-md-8">

<table width="200" border="1" class="table table-striped">
  <tr>
    <td> Description</td>
    <td><?=$data['description']?></td>
    </tr>
  <tr>
    <td>Medical Code</td>
    <td>
      <?=$data["medical_code"]?>
    </td>
    </tr>
  <tr>
    <td>Facility</td>
    <td>
        <?=$data["facility"]?>
        </td>
    </tr>
  <tr>
    <td>Facility Zip Code</td>
    <td>
      <?=$data["facility_zip_code"]?>
    </td>
    </tr>
  <tr>
    <td>
      Date</td>
    <td>
      <?=$data["date"]?>
    </td>
    </tr>
  <tr>
    <td>Cost</td>
    <td>
      <div class="col-sm-7">
        <?=$data["cost"]?>
        </div>
    </td>
    </tr>
  <tr>
    <td>
      Physician
      </td>
    <td>
      <?=$data["physician"]?>
      </td>
  </tr>
  <tr>
    <td>
      Keywords
      </td>
    <td>
      <?=$data["keywords"]?>
      </td>
  </tr>
  </table>
<div class="form-group">
  <div class="col-sm-7"></div>
</div>
  <div class="form-group">
    <div class="col-sm-7"></div>
  </div>
  <div class="form-group">
    <div class="col-sm-7"></div>
  </div>
  <div class="form-group">
    <div class="col-sm-7"></div>
  </div>
  <div class="form-group">
    <div class="col-sm-7"></div>
  </div>
  <div class="form-group">
    <div class="col-sm-7"></div>
  </div>
  <div class="form-group">
    <div class="col-sm-7"></div>
  </div>
<div class="form-group"></div>
<div class="form-group">
  <div class="col-sm-7"></div>
</div>
</div>
</div>




<?
//Including bottom footer file
include "includes/footer.php" ?>