<div align="center" style="font-family:Tahoma, Geneva, sans-serif; font-size:18px; color:#666666"><br><br><? 

if(isset($_SESSION['user_id'])){
    
}elseif(isset($_SESSION['BrowseOn'])){ ?>
You are browsing anonymously. <? }else{?>
You have just authenticated.<? } ?> Please use the menu above to navigate </div>