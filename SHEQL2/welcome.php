<div align="center" style="font-family:Tahoma, Geneva, sans-serif; font-size:18px; color:#666666"><? 

if(isset($_SESSION['user_name'])){
    echo "Welcome {$_SESSION['user_name']}";
}

?>

<br><br>
<? if(!(isset($_SESSION['BrowseOn']))){ ?>
You are browsing anonymously.
<? } else { ?>
Please use the menu above to navigate. </div>
<? } ?>