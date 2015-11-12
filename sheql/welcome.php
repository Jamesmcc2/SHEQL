<div align="center" style="font-family:Tahoma, Geneva, sans-serif; font-size:18px; color:#666666"><? 

if(isset($_SESSION['user_name'])){
    echo "Welcome {$_SESSION['user_name']}";
}

?>

<br><br>
<? if(isset($_SESSION['BrowseOn']) && !isset($_SESSION['user_id'])){ ?>
You are browsing anonymously. <? }else{?>
You have just authenticated.<? } ?> Please use the menu above to navigate. </div>