<?php 
//Including top header file
include 'includes/header.php';?>
<script type="text/javascript">
  
function confirmAction(){
      var confirmed = confirm("Are you sure? This will remove this entry forever.");
      return confirmed;
}
</script>

<? if($super!=2) die("Not Found!!"); ?>

        <div class="row">
          <div class="col-lg-12">
            <h1>List of <small>Records</small></h1>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-bar-chart-o"></i> List of Members</li></ol>
          </div>
        </div><!-- /.row -->





        <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                  <tr>
                    <th width="14%">Full Name<i class="fa fa-sort"></i></th>
                    <th width="14%">Email <i class="fa fa-sort"></i></th>
					<th width="14%">Address <i class="fa fa-sort"></i></th>
					<th width="14%">Zip <i class="fa fa-sort"></i></th>
					<th width="14%">No of Bills Uploaded <i class="fa fa-sort"></i></th>
                    <th width="14%">Action <i class="fa fa-sort"></i></th>
                  </tr>
                </thead>
                <tbody>    <?php 

	  		$count=1;
			$qry_all_prod=$qry->querySelect("select *from  sn_users");
			foreach($qry_all_prod as $prod)
			{?>
                  <tr>
                    <td><?=$prod['firstname'] ?> <?=$prod['middlename'] ?> <?=$prod['lastname'] ?></td>
                    <td><?=$prod['email'] ?></td>
					<td><?=$prod['address'] ?></td>
					<td><?=$prod['zip'] ?></td>
                    <td><?=count_rows("sn_pictures",array("user_id",$prod['user_id']),1) ?></td>                
                    <td><? if($prod["user_id"]!=$_SESSION["user_id"]){ ?><a href="records.php?user_id=<?=$prod["user_id"] ?>">Bills</a> | <a href="editMembers.php?user_id=<?=$prod['user_id'] ?>">Edit</a> | <a  onClick="return confirmAction();" href="formHandler.php?deleteMembers&user_id=<?=$prod['user_id'] ?>">Delete</a><? } else{?>LOGGED USER<? } ?></td>
                  </tr><?php } ?>
                </tbody>
              </table>
            </div>
          </div>


<?php
//Including bottom footer file
include 'includes/footer.php';?>