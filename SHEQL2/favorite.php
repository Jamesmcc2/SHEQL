<?php 
//Including top header file
include "includes/header.php" ?>
<?php 
if(isset($_SESSION['BrowseOn']))
{
?>

  <?php
  if(isset($_REQUEST["fav_id"]))
{		
		$results=$qry->queryExecute("insert into sn_favorites SET pic_id = '".sbGet("fav_id")."', user_id = '".$_SESSION["user_id"]."' ");
		phpredirect("favorite.php");
}


  if(isset($_REQUEST["unfav_id"]))
{		
		$results=$qry->queryExecute("delete from sn_favorites where pic_id = '".sbGet("unfav_id")."' and user_id = '".$_SESSION["user_id"]."' ");
		phpredirect("favorite.php");
}
		
		$queryData="Select *from sn_pictures where pic_id in (Select pic_id from  sn_favorites where user_id='".$_SESSION['user_id']."')
						order by `cost` desc";

	$num = $qry->numRows($queryData); 

	?>
  
  <!-- Main component for a primary marketing message or call to action -->
    
    <div class="row">
	<div class="col-md-12">
	
	<?php
	if($num>0)
	{
  ?><table width="100%" border="0" class="table table-striped">

<tr>
<th width="3%" align="center">SN. </th>
<th width="31%" align="center">Description</th>
<th width="31%" align="center">Cost</th>
<th width="10%" align="left">Favorite</th>
<?php if(isset($_SESSION['user_id'])){?><th width="20%" align="center">Image</th><?php } ?>
<th width="5%" align="center">Details</th>

</tr>

<?php
$count=1;
			$qry_all_prod=$qry->querySelect($queryData);
			foreach($qry_all_prod as $data)
			{
				$query = "select * from  sn_images where  	picture_id='".$data['pic_id']."' ";
$img=$qry->querySelectSingle($query);
				
					
$sql="SELECT * FROM  sn_favorites WHERE pic_id = '".$data['pic_id']."' and user_id='".$_SESSION['user_id']."'";


$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$num=mysql_num_rows($result);





				?>   <tr>
                <td align="left"><?php echo $count;?></td>
    <td align="left"><a href="view.php?picture_id=<?=$data['pic_id'] ?>"><?=$data['description']?></a></td>
    <td align="left"><a href="view.php?picture_id=<?=$data['pic_id'] ?>">
      <?=$data['cost']?>
    </a></td>
    <td align="left"><p>
    <?php if($num==0){?>
    <a href="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>?a&fav_id=<?=$data['pic_id'] ?>" class="btn btn-primary btn-sm" role="button"><span class="glyphicon glyphicon-heart"></span> Favorite</a>&nbsp;<?php }else{?>
    
	 <a href="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>?a&unfav_id=<?=$data['pic_id'] ?>" class="btn btn-danger btn-sm" role="button"><span class="glyphicon glyphicon-heart"></span> Unfavorite</a>
	<?php } ?></p></td>
    <?php if(isset($_SESSION['user_id'])){?><td align="center"><a href="view.php?picture_id=<?=$data['pic_id'] ?>">
    <img src="uploads/thumbs/<?=$img['file'] ?>" width="150" />
     </a></td><?php } ?>
    <td align="center"><a  class="btn btn-default btn-sm" role="button" href="view.php?picture_id=<?=$data['pic_id'] ?>"><span class="glyphicon glyphicon-heart"></span> Details</a> </a></td>

  </tr> 

    <?php $count++;} ?></table><?php } else{?><div class="alert alert-danger">No Items Found</div><?php } ?></div>
    

	
	    </div>


</div>


<?php }
//Including bottom footer file

include "includes/footer.php" ?>