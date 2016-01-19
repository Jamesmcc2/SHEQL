  <?php

//if favorite is clicked
if(isset($_REQUEST["fav_id"]))
{		
		$results=$qry->queryExecute("insert into sn_favorites SET pic_id = '".sbGet("fav_id")."', user_id = '".$_SESSION["user_id"]."' ");
		phpredirect("search.php?q=".sbGet('q')."&s=".sbGet('s'));
}

//if unfavorite is clicked
  if(isset($_REQUEST["unfav_id"]))
{		
		$results=$qry->queryExecute("delete from sn_favorites where pic_id = '".sbGet("unfav_id")."' and user_id = '".$_SESSION["user_id"]."' ");
		phpredirect("search.php?q=".sbGet('q')."&s=".sbGet('s'));
}



  ?>
  
  <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h2>Search        </h2>
        <form name="form1" class="form-horizontal"  method="get" action="">
         <div class="col-sm-4">
      <input name="q" type="search" class="form-control" id="inputEmail3" placeholder="search"></div>
       <div class="col-sm-4">
    <label for="inputEmail3" class="col-sm-4 control-label">Search By </label>
    <div class="col-sm-8">
    <select class="form-control" name="s" id="s">
      <option value="description">Description</option>
      <option value="medical_code">Medical Code</option>
      <option value="zip_code">Zip Code</option>
      <option value="keywords">Keywords</option>
    </select></div>
         </div>
     <div class="col-sm-2">
       <label>
         <input type="submit" name="Search" id="Search" class="btn btn-md btn-primary" value="Search">
       </label>
     </div>
        </form>
      </div>
    <div >
    
    <?php 		
	
	//check if q is there in the url
	if(isset($_GET['q']))
	{
	$count=1;
		$q=$_GET['q'];
		$searchby = $_GET['s'];
		$queryData="Select *from sn_pictures where ".$searchby." LIKE '%".$q."%' 
						order by `cost` desc ";

		$num = $qry->numRows($queryData); 
		
		?><div class="row">
	<div class="col-md-12">
    	<?php
		
		//if search result is not empty
	if($num>0)
	{
  ?>
    <table width="100%" border="0" class="table table-striped">

<tr>
<th width="3%" align="center">SN. </th>
<th width="31%" align="center">Description</th>
<th width="31%" align="center">Cost</th>
<?php if(isset($_SESSION['user_id'])){?><th width="10%" align="left">Favorite</th>
<th width="20%" align="center">Image</th><?php } ?>
<th width="5%" align="center">Details</th>

</tr>

<?php

			$qry_all_prod=$qry->querySelect($queryData);
			foreach($qry_all_prod as $data)
			{
				$query = "select * from  sn_images where  	picture_id='".$data['pic_id']."' ";
$img=$qry->querySelectSingle($query);
				
if(isset($_SESSION['user_id']))					
$sql="SELECT * FROM  sn_favorites WHERE pic_id = '".$data['pic_id']."' and user_id='".$_SESSION['user_id']."'";
else
	$sql = "SELECT * FROM  sn_favorites ";

$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$num=mysql_num_rows($result);





				?>   <tr>
                <td align="left"><?php echo $count;?></td>
    <td align="left"><a href="view.php?picture_id=<?=$data['pic_id'] ?>"><?=$data['description']?></a></td>
    <td align="left"><a href="view.php?picture_id=<?=$data['pic_id'] ?>">
      <?=$data['cost']?>
    </a></td>
       <?php if(isset($_SESSION['user_id'])){?> <td align="left"><p>
    <?php if($num==0){?>
    <a href="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>&fav_id=<?=$data['pic_id'] ?>" class="btn btn-primary btn-sm" role="button"><span class="glyphicon glyphicon-heart"></span> Favorite</a>&nbsp;<?php }else{?>
    
	 <a href="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>&unfav_id=<?=$data['pic_id'] ?>" class="btn btn-danger btn-sm" role="button"><span class="glyphicon glyphicon-heart"></span> Unfavorite</a>
	<?php } ?></p></td>
<td align="center"><a href="view.php?picture_id=<?=$data['pic_id'] ?>">
    <img src="uploads/thumbs/<?=$img['file'] ?>" width="150" />
     </a></td><?php } ?>
    <td align="center"><a  class="btn btn-default btn-sm" role="button" href="view.php?picture_id=<?=$data['pic_id'] ?>"><span class="glyphicon glyphicon-heart"></span> Details</a> </a></td>

  </tr> 

    <?php $count++;} ?></table><?php } ?></div>
	<?php 
	//if search resutlt is empty
	if($count == 1){?><div class="alert alert-danger">No Items Found</div><?php } ?>
	
	    </div>
	<?php }?>

</div>