<?php 
//Including top header file
include 'includes/header.php';?>
<script type="text/javascript">
  
function confirmAction(){
      var confirmed = confirm("Are you sure? This will remove this entry forever.");
      return confirmed;
}
</script>
<? 


?>


        <div class="row">
          <div class="col-lg-12">
            <h1>List of <small>Records</small></h1>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-bar-chart-o"></i> List of Uploads</li></ol>
          </div>
        </div><!-- /.row -->





        <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                  <tr>
                    <th width="14%">Description<i class="fa fa-sort"></i></th>
                    <th width="14%">keywords <i class="fa fa-sort"></i></th>
					<th width="14%">Physician <i class="fa fa-sort"></i></th>
					<th width="14%">Billing Code <i class="fa fa-sort"></i></th>
					<th width="14%">Facility <i class="fa fa-sort"></i></th>
					<th width="14%">Facility Zip Code<i class="fa fa-sort"></i></th>
                    <th width="12%">Date <i class="fa fa-sort"></i></th>
                    <th width="12%">Cost <i class="fa fa-sort"></i></th>
                    <th width="14%">Action <i class="fa fa-sort"></i></th>
                  </tr>
                </thead>
                <tbody>    <?php 
	  if((isset($_REQUEST['user_id'])) && $super==2){
	  $where =  " where user_id='".$_REQUEST['user_id']."' ";
	  }
	  else
	  {
		  $where = "where user_id='".$_SESSION['user_id']."'";
	  }
	  		$count=1;
			$qry_all_prod=$qry->querySelect("select *from  sn_pictures $where");
			foreach($qry_all_prod as $prod)
			{?>
                  <tr>
                    <td><a href="view.php?picture_id=<?=$prod['pic_id'] ?>"><?=$prod['description'] ?></a></td>
                    <td><?=$prod['keywords'] ?></td>
					<td><?=$prod['physician'] ?></td>
					<td><?=$prod['medical_code'] ?></td>
					<td><?=$prod['facility'] ?></td>
					<td><?=$prod['facility_zip_code'] ?></td>
                    <td><?=$prod['date'] ?></td>
   					<td><?=$prod['cost'] ?></td>
                    
 
                    <td><a href="editUploads.php?pic_id=<?=$prod['pic_id'] ?>">Edit</a> | <a  onClick="return confirmAction();" href="formHandler.php?deletePicture&pic_id=<?=$prod['pic_id'] ?>">Delete</a></td>
                  </tr><?php } ?>
                </tbody>
              </table>
            </div>
          </div>


<?php
//Including bottom footer file
include 'includes/footer.php';?>