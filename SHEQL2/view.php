<? 
//Including top header file
include "includes/header.php";

//Retrieving data from database to show records of bills with the help of unique bill picture_id
$query = "select * from  sn_pictures where  	pic_id='".sbGet('picture_id')."' ";
$data=$qry->querySelectSingle($query);
?>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>

<style>  
      ul li img {
          cursor: pointer;
      }</style>
<div class="row">

<div class="col-md-4">
<form action="formHandler.php" method="post" enctype="multipart/form-data" name="myform"   onsubmit="return validateForm()" role="form">
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Email</label>
    <div class="col-sm-8">
       <input name="email" type="text" class="form-control" id="inputPassword" value="<? echo getData("email","sn_users",array("user_id", $_SESSION["user_id"])); ?>" placeholder="Password" required>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">Message</label>
    <div class="col-sm-8">
      <textarea name="message" rows="10" required="required" class="form-control" id="message" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers" onchange=" this.setCustomValidity(this.validity.patternMismatch ? this.title : ''); if(this.checkValidity()) form.pwd2.pattern = this.value; " pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"></textarea>
    </div>
  </div>
  <div class="form-group"></div>
  <input name="user_id" type="hidden" value="<?=$data['user_id'] ?>" />
  <input name="pic_id" type="hidden" value="<? echo sbGet('picture_id'); ?>" />
  <div class="form-group">
    <div align="right" class="col-sm-offset-2 col-sm-8">
    <input name="contactUser" type="submit" class="btn btn-default" id="contactUser" value="Message">
    </div>
  </div>
</form>
  </div>

<div class="col-md-8">

<table width="200" border="1" class="table table-striped">
  <tr>
    <td> Description</td>
    <td><?=$data['description']?></td>
    </tr>
  <tr>
    <td>Billing Code</td>
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