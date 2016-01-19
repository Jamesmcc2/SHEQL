<?
class query{
			function query(){
				//default constructor
			}
			
			function querySelect($qry)
			{
				$i=0;
				$data=array();
			  $qry_result=mysql_query($qry) or die("QUERY ERROR1=>".mysql_error());
			  //echo $qry;exit;
			  while ($row=mysql_fetch_assoc($qry_result)) {
          	$data[$i] = $row;
          	$i++;
          }
			  return $data;
			}
			
			
			function querySelectSingle($qry)
			{
			 $qry_result=mysql_query($qry) or die("QUERY ERRORSingle=>".mysql_error());
			 $row=mysql_fetch_assoc($qry_result);
			  return $row;
			}
			
			
			
			function numRows($nr)
			{
			$qry_result1=mysql_query($nr) or die("QUERY ERROR2=>".mysql_error());
			$num_row=mysql_num_rows($qry_result1);
			return $num_row;
			 
			}
			function queryDelete($qd)
			{
			  $result_delete=mysql_query($qd) or die("QUERY ERROR3=>".mysql_error());
			  return $result_delete;
			}
			function queryInsert($qd)
			{
			  $result_insert=mysql_query($qd) or die("QUERY ERROR4=>".mysql_error());
			  return $result_insert;
			}
			function queryUpdate($qd)
			{
			  $result_update=mysql_query($qd) or die("QUERY ERROR5=>".mysql_error());
			  return $result_update;
			}
			function queryExecute($query)
			{
			  $result_update=mysql_query($query) or die("QUERY ERROR6=>".mysql_error());
			  return mysql_affected_rows();
			}
			//function querySelectSingle($qry)
			//{
			// $qry_result=mysql_query($qry) or die("QUERY ERRORSingle=>".mysql_error());
			 //$row=mysql_fetch_assoc($qry_result);
			  //return $row;
			//}
			
			/*vinod*/
			function getNewID($tableName){
				$sqlStatement="select max(id) from ".$tableName;
				$returnID=mysql_query($sqlStatement) or die(mysql_error());
				if($returnID){
					$iDRow=mysql_fetch_array($returnID);
					if($iDRow["max(id)"]==null){
						$id=1;
						return $id;		
					}else{
						$id=$iDRow["max(id)"];
						$id=$id+1;	
						return $id;
					}
				}		
			
			}
			/*vinod*/
}

$qry=new query;

function tags($content){ 
return addslashes(nl2br(htmlspecialchars($content)));
 }
 
 function creategallerythumb($image, $des, $src, $wi, $he){

$imagesize=getimagesize($src.$image);
$width = $imagesize[0];
$height = $imagesize[1];
$type=$imagesize[2];
if($width>=$height){
$new_width=$wi;
@$ratio=($new_width/$width);
$new_height=round($height*$ratio);
}else{
$new_height=$he;
$ratio=($new_height/$height);
$new_width=round($width*$ratio);
}
$imagefile=$src.$image;
list($width, $height) = getimagesize($imagefile);
@$image_p = imagecreatetruecolor($new_width,$new_height);
if ($imagesize[2] == "1"){
$img = @imagecreatefromgif($imagefile);
imagecopyresampled($image_p, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
$thename=$image;
//$thenames="thumb$thename";
$location=$des.$thename;
imagegif($image_p,$location, 100);

}
if ($imagesize[2] == "2"){
{
$img = @imagecreatefromjpeg($imagefile);
imagecopyresampled($image_p, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
$thename=$image;
//$thenames="thumb$thename";
$location=$des.$thename;
imagejpeg($image_p,$location, 100);
}
}
}
 

//message alert
function phpalert($message){
echo("<script language='javascript'>alert('".$message."');</script>");
}

//history.back
function phpback(){
echo("<script language='javascript'>history.back(-1);</script>");
}

//location redirection
function phpredirect($location){
echo("<script language='javascript'>location.href='$location';</script>");
}

//generate today
function phptoday(){
$thedate = date("Y-m-d");
return $thedate;
}
?>